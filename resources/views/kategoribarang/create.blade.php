@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Tambah Kategori Barang</span>
                    <a href="{{ route('kategoribarang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('kategoribarang.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                name="nama_kategori" value="{{ old('nama_kategori') }}" placeholder="Nama Kategori" required>
                            @error('nama_kategori')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
