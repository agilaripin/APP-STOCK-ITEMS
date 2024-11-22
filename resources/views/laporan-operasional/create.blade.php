<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan Operasional</title>
</head>
<body>
    <h1>Tambah Laporan Operasional</h1>

    <form action="{{ url('/laporan-operasional') }}" method="POST">
        @csrf
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" required><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" required><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
