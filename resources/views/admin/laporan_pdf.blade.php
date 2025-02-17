<!DOCTYPE html>
<html>
<head>
    <title>Laporan {{ $tanggal }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Laporan Transaksi - {{ $tanggal }}</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>Metode Pembayaran</th>
        </tr>
        @foreach ($transaksi as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->total_harga }}</td>
                <td>{{ $t->metode_pembayaran }}</td>
            </tr>
        @endforeach
    </table>

    <h2>Laporan Restock Barang - {{ $tanggal }}</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga Beli</th>
            <th>Tanggal Restock</th>
        </tr>
        @foreach ($pembelian as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->barang->nama }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->harga_beli }}</td>
                <td>{{ $p->created_at }}</td>
            </tr>
        @endforeach
    </table>

    <h2>Stok Barang Saat Ini</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga</th>
        </tr>
        @foreach ($stok as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->stok }}</td>
                <td>{{ $s->harga }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>
