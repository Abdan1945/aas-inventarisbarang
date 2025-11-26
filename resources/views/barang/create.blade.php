@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Tambah Barang</strong>
                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf

                        {{-- Nama Barang --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang"
                                   class="form-control @error('nama_barang') is-invalid @enderror"
                                   value="{{ old('nama_barang') }}"
                                   placeholder="Masukkan nama barang" required>
                            @error('nama_barang')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label for="">Kategori</label>
                            <select name="id_kategori[]" class="form-control @error('id_kategori') is-invalid @enderror">
                                <option value="Kategori">---- Pilih Kategori ----</option>
                                @foreach ($kategoris as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok') }}"
                                   placeholder="Jumlah stok" min="0" required>
                            @error('stok')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Harga Satuan --}}
                        <div class="mb-3">
                            <label class="form-label">Harga Satuan</label>
                            <input type="number" name="harga_satuan"
                                   class="form-control @error('harga_satuan') is-invalid @enderror"
                                   value="{{ old('harga_satuan') }}"
                                   placeholder="Harga satuan (Rp)" min="0" required>
                            @error('harga_satuan')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
