@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <strong>Edit Kategori Barang</strong>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('kategoribarang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('kategoribarang.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text"
                                   class="form-control @error('nama_kategori') is-invalid @enderror"
                                   name="nama_kategori"
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   placeholder="Masukkan nama kategori"
                                   required>
                            @error('nama_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Perbarui</button>
                        <a href="{{ route('kategoribarang.index') }}" class="btn btn-sm btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
