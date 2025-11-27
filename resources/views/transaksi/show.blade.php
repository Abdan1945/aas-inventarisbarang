@extends('layouts.dashboard')

@section('content')
<div class="container">

    <h2>Detail Transaksi</h2>
    <hr>

    <table class="table table-bordered">
        <tr>
            <th>Kode Transaksi</th>
            <td>{{ $transaksi->kode_transaksi }}</td>
        </tr>

        <tr>
            <th>Tanggal</th>
            <td>{{ $transaksi->tanggal }}</td>
        </tr>

        <tr>
            <th>Jenis</th>
            <td>{{ ucfirst($transaksi->jenis) }}</td>
        </tr>

        <tr>
            <th>Keterangan</th>
            <td>{{ $transaksi->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <h4>Detail Barang</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->details as $detail)
                <tr>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>

</div>
@endsection
