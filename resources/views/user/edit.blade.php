<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        select {
            cursor: pointer;
        }

        button {
            background-color: #4c1c62;
            color: white;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4c1c62;
        }

        .cancel-btn {
            background-color: #9486a6;
            margin-top: 10px;
        }

        .cancel-btn:hover {
            background-color: #8c7ca1;
        }

        .alert {
            background-color: #ebefe1;
            padding: 15px;
            border-radius: 8px;
            color: #4c1c62;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .form-container {
                padding: 15px;
                width: 90%;
            }
        }

    </style>
</head>
<body>

    <div class="form-container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $kartu->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <div class="form-group">
                <label for="no_kartu">No Kartu:</label>
                <input type="number" name="no_kartu" id="no_kartu"
                    value="{{ old('no_kartu', $kartu->no_kartu ?? '') }}" 
                    required>
            </div> 

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama"
                    value="{{ old('nama', $kartu->nama ?? '') }}" 
                    required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" id="alamat"
                    value="{{ old('alamat', $kartu->alamat ?? '') }}" 
                    required>
            </div>

            <div class="form-group">
                <label for="no_hp">No. HP:</label>
                <input type="number" name="no_hp" id="no_hp"
                    value="{{ old('no_hp', $kartu->no_hp ?? '') }}" 
                    required>
            </div>

            <button type="submit">Edit User</button>
        </form>

        <!-- Cancel Button -->
        <a href="{{ route('users.index') }}">
            <button type="button" class="cancel-btn">Batal</button>
        </a>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

</body>
</html>
