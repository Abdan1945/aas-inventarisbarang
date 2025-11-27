@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h3>Tambah Transaksi</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <select name="jenis" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Keterangan (opsional)</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <hr>

        <h5>Detail Barang</h5>

        <div class="row">
            <div class="col-6">
                <label>Barang</label>
                <select name="details[0][barang_id]" class="form-control" required>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label>Jumlah</label>
                <input type="number" name="details[0][jumlah]" class="form-control" min="1" required>
            </div>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection
