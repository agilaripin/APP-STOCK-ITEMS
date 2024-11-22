<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Belanja Harian</title>
</head>
<body>
    <h1>Tambah Belanja Harian</h1>

    <form action="{{ url('/web/belanja-harian') }}" method="POST">
        @csrf
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" required><br>

        <label for="harga_beli">Harga Beli</label>
        <input type="text" name="harga_beli"><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumalah" required><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
