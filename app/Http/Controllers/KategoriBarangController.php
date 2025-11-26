<?php
namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $kategori = KategoriBarang::all();
        return view('kategoribarang.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategoribarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategoribarang.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 🔹 Tambahkan method ini:
    public function show($id)
    {
        $kategoribarang = KategoriBarang::findOrFail($id);
        return view('kategoribarang.show', compact('kategoribarang'));
    }


    public function edit($id)
    {
         $kategori = KategoriBarang::findOrFail($id);
         return view('kategoribarang.edit', compact('kategori'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = KategoriBarang::findOrFail($id);
        $kategori->update(['nama_kategori' => $request->nama_kategori]);

        return redirect()->route('kategoribarang.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kategori = KategoriBarang::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategoribarang.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
