@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-3">Detail Pelanggan</h2>
 <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    <div class="card p-4">
        <div class="mb-3">
            <strong>Nama:</strong>
            <p>{{ $user->nama }}</p>
        </div>

        <div class="mb-3">
            <strong>Email</strong>
            <p>{{ $user->email }}</p>
        </div>

        <div class="mb-3">
            <strong>Password</strong>
            <p>{{ $user->password }}</p>
        </div>

        <a href="{{ route('nama.edit', $pelanggan->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
