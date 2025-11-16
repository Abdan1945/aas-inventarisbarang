@extends('layouts.main')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <strong>Detail User</strong>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $nama->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $nama->email }}</td>
                </tr>
                <tr>
                    <th>Password (hash)</th>
                    <td>{{ $nama->password }}</td>
                </tr>
            </table>

            <a href="{{ route('nama.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

</div>
@endsection
