@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Edit Barang</span>
                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
                                value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                            @error('nama_barang')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ $barang->kategori_id == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                value="{{ old('stok', $barang->stok) }}" required>
                            @error('stok')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Satuan</label>
                            <input type="number" name="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror"
                                value="{{ old('harga_satuan', $barang->harga_satuan) }}" required>
                            @error('harga_satuan')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
