@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Daftar Transaksi</h1>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Buat Transaksi Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Jumlah Item</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
            <tr>
                <td>{{ $t->kode_transaksi }}</td>
                <td>{{ $t->tanggal }}</td>
                <td>{{ ucfirst($t->jenis) }}</td>
                <td>{{ $t->details()->count() }}</td>
                <td>
                    <a href="{{ route('transaksi.show', $t) }}" class="btn btn-info btn-sm">Detail</a>
                    <form action="{{ route('transaksi.destroy', $t) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transaksi->links() }}
</div>
@endsection

