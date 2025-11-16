<?php
namespace App\Http\Controllers;

use App\Models\Nama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NamaController extends Controller
{
    public function index()
    {
        $namas = Nama::all();
        return view('nama.index', compact('namas')); // compact variabel $namas
    }

    public function create()
    {
        return view('nama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:namas,email',
            'password' => 'required|string|min:6',
        ]);

        Nama::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // hash password
        ]);

        return redirect()->route('nama.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show(Nama $nama)
    {
        return view('nama.show', compact('nama'));
    }

    public function edit(Nama $nama)
    {
        return view('nama.edit', compact('nama'));
    }

    public function update(Request $request, Nama $nama)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:namas,email,' . $nama->id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // update password hanya jika diisi
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $nama->update($data);

        return redirect()->route('nama.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Nama $nama)
    {
        $nama->delete();
        return redirect()->route('nama.index')->with('success', 'Data berhasil dihapus!');
    }
}
