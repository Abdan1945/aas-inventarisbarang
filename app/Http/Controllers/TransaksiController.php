<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Services\KodeTransaksiService;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksi = Transaksi::with(['barang', 'creator'])->latest('tanggal')->paginate(20);
        return view('transaksi.index', compact('transaksi'));
    }

    // Form tambah transaksi
    public function create()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        return view('transaksi.create', compact('barang'));
    }

    // Simpan transaksi baru
    public function store(StoreTransaksiRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $kode = KodeTransaksiService::generate($validated['jenis']);
            $transaksi = Transaksi::create([
                'kode_transaksi' => $kode,
                'tanggal' => $validated['tanggal'],
                'jenis' => $validated['jenis'],
                'keterangan' => $validated['keterangan'] ?? null,
                'created_by' => auth()->id(),
            ]);

            foreach ($validated['details'] as $detail) {
                $barang = Barang::lockForUpdate()->findOrFail($detail['barang_id']);
                $jumlah = (int) $detail['jumlah'];

                if ($validated['jenis'] === 'masuk') {
                    $barang->stok += $jumlah;
                } else {
                    if ($barang->stok < $jumlah) {
                        throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi.");
                    }
                    $barang->stok -= $jumlah;
                }
                $barang->save();

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $jumlah,
                ]);
            }
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Detail transaksi
    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['details.barang', 'creator']);
        return view('transaksi.show', compact('transaksi'));
    }

    // Hapus transaksi (stok dikembalikan)
    public function destroy(Transaksi $transaksi)
    {
        DB::transaction(function () use ($transaksi) {
            foreach ($transaksi->details()->with('barang')->get() as $detail) {
                $barang = Barang::lockForUpdate()->find($detail->barang_id);
                if (!$barang) continue;

                if ($transaksi->jenis === 'masuk') {
                    $barang->stok = max(0, $barang->stok - $detail->jumlah);
                } else {
                    $barang->stok += $detail->jumlah;
                }
                $barang->save();
            }
            $transaksi->delete();
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus dan stok disesuaikan.');
    }
}

