@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
    <h2 class="mb-3">Edit Nama</h2>

    <form action="{{ route('pelanggan.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
        </div>

        <div class="mb-3">
            <label>email</label>
            <textarea name="email" class="form-control" required>{{ $user->email }}</textarea>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="{{ $user->password }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
