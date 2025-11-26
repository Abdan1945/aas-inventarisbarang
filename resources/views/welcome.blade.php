<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang | Data Barang Sekolah</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            overflow: hidden;
            height: 100vh;
            background: linear-gradient(135deg, #ff7eb3, #6dd5fa, #69c3ff, #c3a3ff);
            background-size: 400% 400%;
            animation: gradient 10s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.12);
            padding: 50px 70px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            animation: fadeIn 1.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .container img {
            width: 140px;
            margin-bottom: 15px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        h1 { font-size: 38px; font-weight: 700; margin-bottom: 10px; }
        p { font-size: 18px; margin-bottom: 35px; }

        .btn-group { display: flex; gap: 20px; justify-content: center; }
        a.btn {
            padding: 12px 35px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .login { background: #000; color: white; }
        .login:hover { background: #ff4e4e; }

        .register { border: 2px solid #fff; color: white; }
        .register:hover { background: #fff; color: #000; }

        @media (max-width: 768px) {
            .container { width: 80%; padding: 40px 20px; }
            h1 { font-size: 28px; }
            .btn-group { flex-direction: column; }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Gambar logo alat -->
        <img src="https://cdn-icons-png.flaticon.com/512/1087/1087927.png" alt="Inventory Logo">

        <h1>Selamat Datang</h1>
        <p>Sistem Inventaris Barang Sekolah</p>

        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn login">Login</a>
            <a href="{{ route('register') }}" class="btn register">Register</a>
        </div>
    </div>
</body>
</html>
