<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Daftar Stok Barang</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Ikan</th>
                <th>Stok Awal</th>
                <th>Barang Keluar</th>
                <th>Barang Masuk</th>
                <th>Stok Akhir</th>
                <th>Harga Beli</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->nama_ikan }}</td>
                    <td>{{ $item->stok_awal }}</td>
                    <td>{{ $item->barang_keluar }}</td>
                    <td>{{ $item->barang_masuk }}</td>
                    <td>{{ $item->stok_akhir }}</td>
                    <td>{{ $item->harga_beli }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('stok_barang.create') }}">Tambah Barang</a>
</body>
</html>
