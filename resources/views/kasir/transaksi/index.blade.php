<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Transaksi Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-bold mb-4">Histori Transaksi</h1>

        <!-- Tombol Tambah Transaksi -->
        <div class="mb-4">
            <a href="{{ route('kasir.transaksi.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Tambah Transaksi Baru
            </a>
        </div>

        <!-- Tabel Histori Transaksi -->
        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Kasir</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Metode Pembayaran</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-2">{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                        <td class="border p-2">{{ $transaksi->user->name }}</td>
                        <td class="border p-2">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td class="border p-2">{{ $transaksi->metode_pembayaran }}</td>
                        <td class="border p-2 text-center">
                            <a href="{{ route('kasir.detail-transaksi.index', $transaksi->id) }}" class="text-blue-500 hover:text-blue-700">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 p-4">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
