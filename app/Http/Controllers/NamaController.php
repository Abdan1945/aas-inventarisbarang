<?php
namespace App\Http\Controllers;

use App\Models\Nama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NamaController extends Controller
{
    public function index()
    {
        $data = Nama::all();
        return view('nama.index', compact('data'));
    }

    public function create()
    {
        return view('nama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        Nama::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('nama.index')->with('success', 'Data admin berhasil ditambahkan!');
    }

    public function edit(Nama $nama)
    {
        return view('nama.edit', compact('nama'));
    }

    public function update(Request $request, Nama $nama)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $nama->id,
        ]);

        $nama->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('nama.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Nama $nama)
    {
        $nama->delete();
        return redirect()->route('nama.index')
        ->with('success', 'Data berhasil dihapus!');
    }
}