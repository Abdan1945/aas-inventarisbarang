@extends('layouts.app')
@section('content')
<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jenis</label>
        <select name="jenis" class="form-control">
            <option value="masuk">Masuk</option>
            <option value="keluar">Keluar</option>
        </select>
    </div>
    <div id="item-container">
        <div class="row mb-2 item-row">
            <div class="col">
                <select name="barang_id[]" class="form-control">
                    @foreach($barangs as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" required>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-secondary mb-3" id="add-item">+ Tambah Barang</button>
    <button class="btn btn-success">Simpan Transaksi</button>
</form>

<script>
document.getElementById('add-item').addEventListener('click', function(){
    const container = document.getElementById('item-container');
    const row = document.querySelector('.item-row').cloneNode(true);
    container.appendChild(row);
});
</script>
@endsection
