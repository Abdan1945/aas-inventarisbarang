<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Inventaris Barang Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #E0F7FA 0%, #FFF9C4 100%);
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            background: linear-gradient(180deg, #1976D2 0%, #4FC3F7 100%);
            color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            color: #FFF176;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #FFF176;
            color: #0080ff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #d9fcbd;
        }

        .navbar {
            background: linear-gradient(90deg, #0092d6 0%, #FFF176 50%, #1976D2 100%);
            border: none;
        }

        .navbar-brand {
            color: #1976D2 !important;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center mt-3">Inventaris Barang Sekolah</h4>
        <hr>
        <a href="{{ route('barang.index') }}"><i class="bi bi-box"></i> Barang</a>
        <a href="{{ route('kategoribarang.index') }}"><i class="bi bi-people"></i> Kategori Barang</a>
        <a href="{{ route('transaksi.index') }}"><i class="bi bi-cart-check"></i> Transaksi</a>
        <a href="{{ route('nama.index') }}"><i class="bi bi-cart-check"></i> Nama</a>

    </div>

    <div class="content">
        <nav
            class="navbar navbar-light bg-white shadow-sm mb-4 p-3 rounded d-flex justify-content-between align-items-center">
            <span class="navbar-brand mb-0 h1">@yield('title')</span>
            <div>
                @auth
                    <span class="me-3">Halo, {{ auth()->user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-person-plus"></i> Register
                    </a>
                @endauth
            </div>
        </nav>
        @yield('content')
    </div>
</body>

</html>
