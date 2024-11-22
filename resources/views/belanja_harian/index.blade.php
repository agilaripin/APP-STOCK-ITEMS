<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanja Harian</title>
</head>
<body>
    <h1>Daftar Belanja Harian</h1>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item->nama_barang }} - Jumlah: {{ $item->jumalah }}</li>
        @endforeach
    </ul>

    <a href="{{ route('belanja_harian.create') }}">Tambah Belanja Harian</a>
</body>
</html>
