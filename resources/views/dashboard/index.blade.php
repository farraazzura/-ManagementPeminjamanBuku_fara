<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Dashboard Manajemen</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f6f4ef;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }
        header {
            background-color: #4c1c62;
            color: #ebe8ec;
            max-width: 1100px; 
            margin-top: 10px;
            padding: 30px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .container {
            max-width: 1100px;
            margin-top: 50px;
            padding: 30px;
            background: #ccc7d8;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .container:hover {
            transform: translateY(-5px);
        }
        .welcome-text {
            font-size: 30px;
            font-weight: 600;
            color: #4c1c62;
            margin-bottom: 25px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }
        .menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 40px;
        }
        .menu a {
            text-decoration: none;
            background-color: #4c1c62;
            color: white;
            padding: 18px 35px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            transition: 0.3s ease;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.2);
        }
        .menu a:hover {
            background-color: #35104d;
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
        }
        .menu a:active {
            transform: scale(1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
        .info-card {
            background-color: #ebe8ec;
            padding: 20px;
            border-radius: 10px;
            margin-top: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            color: #4c1c62;
        }
        .info-card h4 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .info-card p {
            font-size: 18px;
            color: #6a5a8d;
        }
        @media screen and (max-width: 768px) {
            .menu {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        Selamat Datang di Dashboard Manajemen Perpustakaan
    </header>
    <div class="container">
        <p class="welcome-text">Silakan pilih menu yang ingin Anda kelola:</p>
        <div class="menu">
            <a href="{{ route('bukus.index') }}">Manajemen Buku</a>
            <a href="{{ route('users.index') }}">Manajemen User</a>
            <a href="{{ route('transaksis.index') }}">Manajemen Transaksi</a>
        </div>
        <div class="info-card">
            <h4>Info:</h4>
            <p>Dashboard ini memudahkan Anda dalam mengelola buku, pengguna, dan transaksi perpustakaan dengan cara yang efisien dan praktis. Pilih menu yang sesuai untuk mulai mengelola data perpustakaan Anda.</p>
        </div>
    </div>
</body>
</html>
