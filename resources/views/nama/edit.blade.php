@extends('layouts.main')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <strong>Edit User</strong>
        </div>

        <div class="card-body">
            <form action="{{ route('nama.update', $nama->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $nama->name }}" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $nama->email }}" required>
                </div>

                <div class="mb-3">
                    <label>Password Baru (opsional)</label>
                    <input type="password" name="password" class="form-control">
                    <small>Kosongkan jika tidak mengganti password.</small>
                </div>

                <button class="btn btn-warning">Update</button>
                <a href="{{ route('nama.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</div>
@endsection
