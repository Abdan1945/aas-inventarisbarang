@extends('layouts.main')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Data Users</strong>
            <a href="{{ route('nama.create') }}" class="btn btn-sm btn-primary">Tambah User</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($namas->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($namas as $nama)
                    <tr>
                        
                        <td>{{ $nama->name }}</td>
                        <td>{{ $nama->email }}</td>
                        <td>{{ $nama->password }}</td>
                        <td>
                            <a href="{{ route('nama.show', $nama->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('nama.edit', $nama->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('nama.destroy', $nama->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
                <div class="alert alert-secondary">Belum ada data users.</div>
            @endif
        </div>
    </div>

</div>
@endsection
