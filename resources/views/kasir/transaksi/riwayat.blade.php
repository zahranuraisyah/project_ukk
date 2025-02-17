<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-80 bg-purple-500 text-white min-h-screen p-6 fixed flex flex-col space-y-6">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
            <h2 class="text-lg font-bold ">Kasir </h2>
        </div>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('kasir.dashboard') }}" class="py-2 px-4 hover:bg-purple-700 rounded-md">Dashboard</a>
            <a href="{{ route('kasir.transaksi.create') }}" class="py-2 px-4 hover:bg-purple-700 rounded-md">New Transaction</a>
            <a href="{{ route('kasir.transaksi.riwayat') }}" class="py-2 text-black px-4 font-semibold bg-white rounded-md">Transaction History</a>
        </nav>
    </aside>

    <div class="flex-1 ml-80 p-6">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center rounded-lg mb-6">
            <h1 class="text-2xl font-semibold">🧾 Riwayat Transaksi</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-700 shadow-md">
                    Logout
                </button>
            </form>
        </header>

        <!-- Tabel Riwayat Transaksi -->
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">📜 Detail Riwayat Transaksi</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-base border"> <!-- FONT DIPERBESAR -->
                    <thead>
                        <tr class="bg-gray-200 text-center">
                            <th class="border p-3">No</th>
                            <th class="border p-3">Tanggal</th>
                            <th class="border p-3">Total Harga</th>
                            <th class="border p-3">Barang & Jumlah</th>
                            <th class="border p-3">Lihat Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $index => $transaksi)
                            <tr class="text-center hover:bg-gray-100">
                                <td class="border p-3">{{ $index + 1 }}</td>
                                <td class="border p-3">{{ $transaksi->tanggal }}</td>
                                <td class="border p-3 font-semibold text-lg text-green-600">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                <td class="border p-3 text-left">
                                    <ul class="list-disc pl-4">
                                        @foreach ($transaksi->detailTransaksi as $detail)
                                            <li class="text-sm">
                                                {{ $detail->barang->nama }} ({{ $detail->jumlah }}x) - 
                                                <span class="text-green-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border p-3">
                                    <a href="{{ route('kasir.detail-transaksi.index', $transaksi->id) }}" class="text-blue-500 hover:text-blue-700 text-lg">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
