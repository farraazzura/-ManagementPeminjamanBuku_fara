<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4c1c62;
            color: #b1aabf;
            max-width: 800px;
            margin: 15px auto;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #ebe8ec;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="date"]:focus, select:focus {
            border-color: #4c1c62;
            outline: none;
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #4c1c62;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #4c1c62;
        }
        .alert {
            text-align: center;
            margin: 10px 0;
        }
        .alert p {
            padding: 10px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #ebefe1;
            color: #4c1c62;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <header>
        <h1>Tambah User</h1>
    </header>

    <div class="container">
        <!-- Tampilkan Pesan -->
        @if(session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Form Tambah User -->
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-container"> 
                <div class="form-group">
                    <label for="no_kartu">No Kartu:</label>
                    <input type="number" name="no_kartu" id="no_kartu >
                </div> 

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" >
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" id="alamat" >
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP:</label>
                    <input type="number" name="no_hp" id="no_hp" >
                </div>

                <button type="submit">Tambah User</button>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            </div>
        </form>
    </div>
</body>
</html>
