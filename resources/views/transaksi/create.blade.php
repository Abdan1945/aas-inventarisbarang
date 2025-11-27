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

        <div id="komponen-wrapper">
            <div class="row komponen-item mb-2">
                <div class="col-5">
                    <label>Barang</label>
                    <select name="details[0][barang_id]" class="form-control komponen-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barangs as $b)
                            <option value="{{ $b->id }}" data-harga="{{ $b->harga_satuan }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <label>Jumlah</label>
                    <input type="number" name="details[0][jumlah]" class="form-control jumlah-input" min="1" value="1" required>
                </div>

                <div class="col-3">
                    <label>Subtotal</label>
                    <input type="text" class="form-control subtotal" readonly value="Rp0">
                </div>

                <div class="col-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm btn-remove">×</button>
                </div>
            </div>
        </div>

        <div class="text-end mb-3">
            <button type="button" class="btn btn-sm btn-secondary" id="btn-add">+ Tambah Barang</button>
        </div>

        <div class="mb-3 text-end">
            <strong>Total: <span id="totalHarga">Rp0</span></strong>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>

<script>
function hitungSubtotal() {
    let total = 0;
    document.querySelectorAll('.komponen-item').forEach((item, index) => {
        let select = item.querySelector('.komponen-select');
        let jumlah = item.querySelector('.jumlah-input');
        let subtotalInput = item.querySelector('.subtotal');

        let harga = select.selectedOptions[0]?.getAttribute('data-harga') || 0;
        let sub = parseInt(harga) * parseInt(jumlah.value || 0);

        subtotalInput.value = 'Rp' + sub.toLocaleString('id-ID');
        total += sub;

        // Update name index agar sesuai
        select.name = `details[${index}][barang_id]`;
        jumlah.name = `details[${index}][jumlah]`;
    });

    document.getElementById('totalHarga').innerText = 'Rp' + total.toLocaleString('id-ID');
}

document.addEventListener('input', hitungSubtotal);
document.addEventListener('change', hitungSubtotal);

document.getElementById('btn-add').addEventListener('click', function() {
    let wrapper = document.getElementById('komponen-wrapper');
    let newRow = wrapper.firstElementChild.cloneNode(true);

    newRow.querySelector('.komponen-select').value = '';
    newRow.querySelector('.jumlah-input').value = 1;
    newRow.querySelector('.subtotal').value = 'Rp0';

    wrapper.appendChild(newRow);
    hitungSubtotal();
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-remove')) {
        let items = document.querySelectorAll('.komponen-item');
        if (items.length > 1) {
            e.target.closest('.komponen-item').remove();
            hitungSubtotal();
        }
    }
});
</script>
@endsection
