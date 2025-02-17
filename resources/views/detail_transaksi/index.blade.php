@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-3">Detail Transaksi</h2>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">Barang</th>
            <th class="p-2 border">Jumlah</th>
            <th class="p-2 border">Harga Satuan</th>
            <th class="p-2 border">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksis->detailTransaksi as $detail)
            <tr>
                <td class="border p-2">{{ $detail->barang->nama }}</td>
                <td class="border p-2">{{ $detail->jumlah }}</td>
                <td class="border p-2">Rp {{ number_format($detail->barang->harga, 0, ',', '.') }}</td>
                <td class="border p-2">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
