<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Ambil semua barang beserta relasi kategori
        $barangs = Barang::with('kategori')->get();

        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $kategoris = KategoriBarang::all();

        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'stok'         => 'required|integer|min:0',
            'kategori_id'  => 'required|exists:kategori_barangs,id',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        Barang::create([
            'nama_barang'  => $request->nama_barang,
            'stok'         => $request->stok,
            'kategori_id'  => $request->kategori_id,
            'harga_satuan' => $request->harga_satuan,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = KategoriBarang::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'stok'         => 'required|integer|min:0',
            'kategori_id'  => 'required|exists:kategori_barangs,id',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $barang->update([
            'nama_barang'  => $request->nama_barang,
            'stok'         => $request->stok,
            'kategori_id'  => $request->kategori_id,
            'harga_satuan' => $request->harga_satuan,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}