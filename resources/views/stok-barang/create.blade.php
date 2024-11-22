<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Tambah Stok Barang</h1>

            <form action="{{ url('/product') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_ikan" class="form-label">Nama Ikan</label>
                    <input type="text" name="nama_ikan" id="nama_ikan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="stok_awal" class="form-label">Stok Awal</label>
                    <input type="number" name="stok_awal" id="stok_awal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="barang_keluar" class="form-label">Barang Keluar</label>
                    <input type="number" name="barang_keluar" id="barang_keluar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="barang_masuk" class="form-label">Barang Masuk</label>
                    <input type="number" name="barang_masuk" id="barang_masuk" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/stok-barang') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
