<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Detail Transaksi</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-700 transition">
                Logout
            </button>
        </form>
    </header>

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto mt-6 bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            🔍 <span class="ml-2">Detail Transaksi</span>
        </h1>

        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <p class="text-sm"><strong>📅 Tanggal:</strong> {{ $transaksi->tanggal }}</p>
            <p class="text-sm"><strong>💰 Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
            <p class="text-sm"><strong>💵 Uang Pembayaran:</strong> Rp {{ number_format($transaksi->uang_pembayaran, 0, ',', '.') }}</p>
            <p class="text-sm"><strong>🔄 Uang Kembalian:</strong> Rp {{ number_format($transaksi->uang_kembalian, 0, ',', '.') }}</p>
            <p class="text-sm"><strong>💳 Metode Pembayaran:</strong> {{ ucfirst($transaksi->metode_pembayaran) }}</p>
        </div>

        <table class="w-full text-sm border rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-purple-400 text-white text-left">
                    <th class="p-3 border">Barang</th>
                    <th class="p-3 border">Harga Satuan</th>
                    <th class="p-3 border">Jumlah</th>
                    <th class="p-3 border">Subtotal</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($transaksi->detailTransaksi as $detail)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-3">{{ $detail->barang->nama }}</td>
                        <td class="border p-3">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="border p-3 text-center">{{ $detail->jumlah }}</td>
                        <td class="border p-3 font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('kasir.transaksi.create') }}" class="mt-6 block text-center bg-purple-500 hover:bg-purple-700 text-white px-5 py-3 rounded-lg transition duration-200">
            ➕ Buat Transaksi Baru
        </a>
    </div>

</body>
</html>
