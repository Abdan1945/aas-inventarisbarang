@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Buat Transaksi</h1>
    <form method="POST" action="{{ route('transaksi.store') }}">
        @csrf
        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <select name="jenis" class="form-control" required>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ now()->toDateString() }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
        </div>

        <h4>Detail Barang</h4>
        <div id="detail-wrapper">
            <div class="row g-2 align-items-end detail-row">
                <div class="col-md-6">
                    <label>Barang</label>
                    <select name="details[0][barang_id]" class="form-control" required>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} (stok: {{ $b->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Jumlah</label>
                    <input type="number" name="details[0][jumlah]" class="form-control" min="1" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-secondary add-row">Tambah Baris</button>
                </div>
            </div>
        </div>

        <button class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    let index = 1;
    document.querySelector('.add-row').addEventListener('click', () => {
        const wrapper = document.getElementById('detail-wrapper');
        const row = document.createElement('div');
        row.className = 'row g-2 align-items-end detail-row mt-2';
        row.innerHTML = `
            <div class="col-md-6">
                <label>Barang</label>
                <select name="details[${index}][barang_id]" class="form-control" required>
                    @foreach($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }} (stok: {{ $b->stok }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Jumlah</label>
                <input type="number" name="details[${index}][jumlah]" class="form-control" min="1" required>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger remove-row">Hapus</button>
            </div>
        `;
        wrapper.appendChild(row);
        row.querySelector('.remove-row').addEventListener('click', () => row.remove());
        index++;
    });
});
</script>

@endsection

