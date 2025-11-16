@extends('layouts.main')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <strong>Tambah User</strong>
        </div>

        <div class="card-body">
            <form action="{{ route('nama.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('nama.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</div>
@endsection
