@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Transaksi: {{ $transaksi->kode_transaksi }}</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Jenis Transaksi --}}
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Transaksi</label>
                            <select name="jenis" class="form-control" required>
                                <option value="masuk" {{ $transaksi->jenis == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                <option value="keluar" {{ $transaksi->jenis == 'keluar' ? 'selected' : '' }}>Keluar</option>
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control"
                                value="{{ old('tanggal', \Carbon\Carbon::parse($transaksi->tanggal)->toDateString()) }}" required>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                            <textarea name="keterangan" class="form-control">{{ old('keterangan', $transaksi->keterangan) }}</textarea>
                        </div>

                        <hr>
                        <h5>Detail Barang</h5>

                        @foreach ($transaksi->details as $i => $det)
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label>Barang</label>
                                    <select name="details[{{ $i }}][barang_id]" class="form-control" required>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}"
                                                {{ $barang->id == $det->barang_id ? 'selected' : '' }}>
                                                {{ $barang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Jumlah</label>
                                    <input type="number" name="details[{{ $i }}][jumlah]" class="form-control"
                                        value="{{ old('details.' . $i . '.jumlah', $det->jumlah) }}" min="1" required>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> 
</div>
@endsection
