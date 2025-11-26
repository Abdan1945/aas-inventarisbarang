@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <strong>Detail Kategori Barang</strong>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('kategoribarang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>ID:</strong></label>
                        <p>{{ $kategoribarang->id }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Nama Kategori:</strong></label>
                        <p>{{ $kategoribarang->nama_kategori }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Dibuat pada:</strong></label>
                        <p>{{ $kategoribarang->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Terakhir diperbarui:</strong></label>
                        <p>{{ $kategoribarang->updated_at->format('d M Y H:i') }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('kategoribarang.edit', $kategoribarang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('kategoribarang.destroy', $kategoribarang->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
