<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        return view('barang.index', compact('barang'));
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
        'kategori_id'  => 'required|array',
        'harga_satuan' => 'required|numeric|min:0',
    ]);


    $barang = Barang::create([
    'nama_barang'  => $request->nama_barang,
    'stok'         => $request->stok,
    'kategori_id'  => $request->kategori_id[0] ?? null, // ambil kategori pertama
    'harga_satuan' => $request->harga_satuan,
]);

$barang->kategoris()->sync($request->kategori_id);

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
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'stok'         => 'required|integer|min:0',
            'kategori_id'  => 'required|array',  // Validasi untuk array kategori
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        // Update barang
        $barang->update([
            'nama_barang'  => $request->nama_barang,
            'stok'         => $request->stok,
            'kategori_id'  => $request->kategori_id,
            'harga_satuan' => $request->harga_satuan,
        ]);

        // Menyinkronkan kategori terkait (relasi many-to-many)
        $barang->kategoris()->sync($request->kategori_id);

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
