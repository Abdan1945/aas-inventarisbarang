<?php
namespace App\Http\Controllers;

use App\Models\Nama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NamaController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $data = Nama::all(); // ambil semua data dari tabel namas
        return view('nama.index', compact('data'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('nama.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:namas,email',
            'password' => 'required|min:6',
        ]);

        Nama::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('nama.index')
            ->with('success', 'Data admin berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit(Nama $nama)
    {
        return view('nama.edit', compact('nama'));
    }

    // Update data
    public function update(Request $request, Nama $nama)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:namas,email,' . $nama->id,
        ]);

        $nama->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('nama.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data
    public function destroy(Nama $nama)
    {
        $nama->delete();
        return redirect()->route('nama.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
