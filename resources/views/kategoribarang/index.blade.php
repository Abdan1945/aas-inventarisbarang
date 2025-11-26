@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Kategori Barang</h5>
            <a href="{{ route('kategoribarang.create') }}" class="btn btn-sm btn-primary">Tambah Kategori</a>
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Kategori</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $i => $item)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>
                                <a href="{{ route('kategoribarang.show', $item->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{ route('kategoribarang.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kategoribarang.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
