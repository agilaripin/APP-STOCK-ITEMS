<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
</head>
<body>
    <h1>Daftar Laporan Penjualan</h1>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item->nama_barang }} - Total Penjualan: {{ $item->total_penjualan }}</li>
        @endforeach
    </ul>

    <a href="{{ route('laporan_penjualan.create') }}">Tambah Laporan Penjualan</a>
</body>
</html>
