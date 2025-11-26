<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    public function index()
    {
        $details = TransaksiDetail::with(['transaksi', 'barang'])->latest()->get();
        return view('transaksi_detail.index', compact('details'));
    }

    public function create()
    {
        $transaksi = Transaksi::all();
        $barang = Barang::all();
        return view('transaksi_detail.create', compact('transaksi', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $transaksi = Transaksi::find($request->transaksi_id);
        $barang = Barang::find($request->barang_id);

        // Update stok otomatis
        if ($transaksi->jenis == 'masuk') {
            $barang->stok += $request->jumlah;
        } else {
            $barang->stok -= $request->jumlah;
        }
        $barang->save();

        TransaksiDetail::create($request->all());

        return redirect()->route('transaksi_detail.index')->with('success', 'Detail transaksi berhasil ditambahkan');
    }

    public function show($id)
    {
        $detail = TransaksiDetail::with(['transaksi','barang'])->findOrFail($id);
        return view('transaksi_detail.show', compact('detail'));
    }

    public function edit($id)
    {
        $detail = TransaksiDetail::findOrFail($id);
        $transaksi = Transaksi::all();
        $barang = Barang::all();
        return view('transaksi_detail.edit', compact('detail','transaksi','barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $detail = TransaksiDetail::findOrFail($id);

        $transaksi = Transaksi::find($request->transaksi_id);
        $barang = Barang::find($request->barang_id);

        // Kembalikan stok lama
        if ($transaksi->jenis == 'masuk') {
            $barang->stok -= $detail->jumlah;
        } else {
            $barang->stok += $detail->jumlah;
        }

        // Tambahkan stok baru
        if ($transaksi->jenis == 'masuk') {
            $barang->stok += $request->jumlah;
        } else {
            $barang->stok -= $request->jumlah;
        }

        $barang->save();

        $detail->update($request->all());

        return redirect()->route('transaksi_detail.index')->with('success', 'Detail transaksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $detail = TransaksiDetail::findOrFail($id);

        $transaksi = $detail->transaksi;
        $barang = $detail->barang;

        // Kembalikan stok
        if ($transaksi->jenis == 'masuk') {
            $barang->stok -= $detail->jumlah;
        } else {
            $barang->stok += $detail->jumlah;
        }
        $barang->save();

        $detail->delete();

        return redirect()->route('transaksi_detail.index')->with('success', 'Detail transaksi berhasil dihapus');
    }
}
