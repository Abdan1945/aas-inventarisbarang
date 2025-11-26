@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-3">Daftar Admin / Nama</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('nama.create') }}" class="btn btn-primary mb-3">+ Tambah Nama</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $u)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->password }}</td>
                    <td>
                        <a href="{{ route('nama.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('nama.destroy', $u->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
