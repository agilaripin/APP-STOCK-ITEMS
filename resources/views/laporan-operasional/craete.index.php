<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Operasional</title>
</head>
<body>
    <h1>Daftar Laporan Operasional</h1>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item->nama_barang }} - Jumlah: {{ $item->jumlah }}</li>
        @endforeach
    </ul>

    <a href="{{ route('laporan_operasional.create') }}">Tambah Laporan Operasional</a>
</body>
</html>
