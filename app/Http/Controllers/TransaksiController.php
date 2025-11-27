<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksi = Transaksi::latest('tanggal')->paginate(20);
        return view('transaksi.index', compact('transaksi'));
    }

    // Form tambah transaksi
    public function create()
    {
        $barangs = Barang::orderBy('nama_barang')->get();
        return view('transaksi.create', compact('barangs'));
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:masuk,keluar',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',

            'details' => 'required|array|min:1',
            'details.*.barang_id' => 'required|exists:barangs,id',
            'details.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {

            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX-' . time(),
                'tanggal' => $validated['tanggal'],
                'jenis' => $validated['jenis'],
                'keterangan' => $validated['keterangan'] ?? null,
                'created_by' => auth()->id(),
            ]);

            foreach ($validated['details'] as $detail) {
                $barang = Barang::lockForUpdate()->findOrFail($detail['barang_id']);

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $detail['barang_id'],
                    'jumlah' => $detail['jumlah'],
                ]);

                // Update stok barang
                if ($validated['jenis'] === 'keluar') {
                    $barang->stok -= $detail['jumlah'];
                } else {
                    $barang->stok += $detail['jumlah'];
                }
                $barang->save();
            }
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    // Tampilkan detail transaksi
    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['details.barang']);
        return view('transaksi.show', compact('transaksi'));
    }

    // Form edit transaksi
    public function edit(Transaksi $transaksi)
    {
        $transaksi->load(['details.barang']);
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('transaksi.edit', compact('transaksi', 'barangs'));
    }

    // Update transaksi
    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:masuk,keluar',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',

            'details' => 'required|array|min:1',
            'details.*.barang_id' => 'required|exists:barangs,id',
            'details.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated, $transaksi) {

            // Kembalikan stok lama
            foreach ($transaksi->details as $old) {
                $barang = Barang::lockForUpdate()->find($old->barang_id);
                if ($barang) {
                    $barang->stok += ($transaksi->jenis === 'keluar') ? $old->jumlah : -$old->jumlah;
                    $barang->save();
                }
            }

            // Hapus detail lama
            $transaksi->details()->delete();

            // Update transaksi utama
            $transaksi->update([
                'tanggal' => $validated['tanggal'],
                'jenis' => $validated['jenis'],
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            // Simpan detail baru & update stok
            foreach ($validated['details'] as $detail) {
                $barang = Barang::lockForUpdate()->findOrFail($detail['barang_id']);

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $detail['barang_id'],
                    'jumlah' => $detail['jumlah'],
                ]);

                if ($validated['jenis'] === 'keluar') {
                    $barang->stok -= $detail['jumlah'];
                } else {
                    $barang->stok += $detail['jumlah'];
                }
                $barang->save();
            }
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Hapus transaksi
    public function destroy(Transaksi $transaksi)
    {
        DB::transaction(function () use ($transaksi) {

            foreach ($transaksi->details as $detail) {
                $barang = Barang::lockForUpdate()->find($detail->barang_id);
                if ($barang) {
                    $barang->stok += $detail->jumlah;
                    $barang->save();
                }
            }

            $transaksi->details()->delete();
            $transaksi->delete();
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
