<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategoribarang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['barang', 'kategoribarangs'])->latest()->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $barang   = Barang::all();
        $kategori = Kategoribarang::all();

        return view('transaksi.create', compact('barang', 'kategoribarangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_barang'       => 'required|exists:barangs,id',
            'id_kategori'     => 'required|array',
            'id_kategori.*'   => 'exists:kategoris,id',
            'jumlah'          => 'required|array',
            'jumlah.*'        => 'integer|min:1',
        ]);

        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'id_barang'      => $request->id_barang,
            'tanggal'        => now(),
            'total_harga'    => 0,
        ]);

        $pivot = [];
        $totalHarga = 0;

        foreach ($request->id_kategori as $idx => $katId) {
            $kategori = Kategoribarang::findOrFail($katId);
            $jumlah   = $request->jumlah[$idx];
            $subtotal = $kategori->harga * $jumlah;

            $pivot[$katId] = [
                'jumlah' => $jumlah,
                'sub_total' => $subtotal,
            ];

            // Kurangi stok
            $kategori->stok -= $jumlah;
            $kategori->save();

            $totalHarga += $subtotal;
        }

        $transaksi->kategoris()->attach($pivot);

        $transaksi->update(['total_harga' => $totalHarga]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['barang', 'kategoris'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('kategoris')->findOrFail($id);
        $barang    = Barang::all();
        $kategori  = Kategoribarang::all();

        return view('transaksi.edit', compact('transaksi', 'barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_barang'       => 'required|exists:barangs,id',
            'id_kategori'     => 'required|array',
            'id_kategori.*'   => 'exists:kategoribarangs,id',
            'jumlah'          => 'required|array',
            'jumlah.*'        => 'integer|min:1',
        ]);

        $transaksi = Transaksi::with('kategoris')->findOrFail($id);

        // Kembalikan stok lama
        foreach ($transaksi->kategoris as $old) {
            $kat = Kategoribarang::find($old->id);
            if ($kat) {
                $kat->stok += $old->pivot->jumlah;
                $kat->save();
            }
        }

        // Hapus relasi lama
        $transaksi->kategoris()->detach();

        $transaksi->update([
            'id_barang' => $request->id_barang,
            'tanggal'   => now(),
            'total_harga' => 0,
        ]);

        $pivot = [];
        $totalHarga = 0;

        foreach ($request->id_kategori as $idx => $katId) {
            $kategori = Kategoribarang::findOrFail($katId);
            $jumlah   = $request->jumlah[$idx];
            $subtotal = $kategori->harga * $jumlah;

            $pivot[$katId] = [
                'jumlah' => $jumlah,
                'sub_total' => $subtotal,
            ];

            $kategori->stok -= $jumlah;
            $kategori->save();

            $totalHarga += $subtotal;
        }

        $transaksi->kategoris()->attach($pivot);

        $transaksi->update(['total_harga' => $totalHarga]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::with('kategoris')->findOrFail($id);

        // Kembalikan stok
        foreach ($transaksi->kategoris as $kategori) {
            $kat = Kategoribarang::find($kategori->id);
            if ($kat) {
                $kat->stok += $kategori->pivot->jumlah;
                $kat->save();
            }
        }

        $transaksi->kategoris()->detach();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
