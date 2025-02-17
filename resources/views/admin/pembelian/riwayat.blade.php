<h2>Riwayat Pembelian</h2>
<table border="1">
    <tr>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Harga Beli</th>
        <th>Total Harga</th>
        <th>Tanggal</th>
    </tr>
    @foreach ($pembelians as $pembelian)
        <tr>
            <td>{{ $pembelian->barang->nama }}</td>
            <td>{{ $pembelian->jumlah }}</td>
            <td>Rp{{ number_format($pembelian->harga_beli, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
            <td>{{ $pembelian->tanggal_pembelian }}</td>
        </tr>
    @endforeach
</table>
