@extends('layouts.main')

@section('content')
<a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">+ Transaksi Baru</a>
<table class="table table-bordered">
    <tr><th>No</th><th>Kode</th><th>Tanggal</th><th>Jenis</th><th>Total</th></tr>
    @foreach($transaksi as $t)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $t->kode_transaksi }}</td>
        <td>{{ $t->tanggal }}</td>
        <td>{{ ucfirst($t->jenis) }}</td>
        <td>{{ number_format($t->total) }}</td>
    </tr>
    @endforeach
</table>
@endsection
