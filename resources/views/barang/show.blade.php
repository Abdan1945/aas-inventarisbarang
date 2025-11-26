@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Detail Barang</span>
                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Barang:</label>
                        <p>{{ $barang->nama_barang }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori:</label>
                        <p>{{ $barang->kategori->nama_kategori ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Stok:</label>
                        <p>{{ $barang->stok }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Harga Satuan:</label>
                        <p>Rp {{ number_format($barang->harga_satuan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
