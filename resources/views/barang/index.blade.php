@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Daftar Barang</h1>
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $barang)
                <tr>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->kategoris->nama_kategori ?? '-' }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>{{ $barang->harga }}</td>
                    <td>
                        <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
