<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Transaksi Kasir</title>
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
            <a href="{{ route('kasir.transaksi.create') }}" class="py-2 text-black px-4 font-semibold bg-white rounded-md">New Transaction</a>
            <a href="{{ route('kasir.transaksi.riwayat') }}" class="py-2 px-4 hover:bg-purple-700 rounded-md">Transaction History</a>
        </nav>
    </aside>

    <div class="flex-1 ml-80 p-6">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Transaksi Kasir</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 rounded">Logout</button>
            </form>
        </header>

        <!-- Form & Tabel -->
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6">
            <!-- Form Input Barang -->
            <form action="{{ route('kasir.transaksi.tambahKeranjang') }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Pilih Barang</label>
                    <select name="barang_id" class="w-full p-3 border rounded" required>
                        <option selected disabled>Pilih barang...</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">
                                {{ $barang->nama }} - Rp {{ number_format($barang->harga, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>        

                <div class="mb-4">
                    <label class="block text-sm font-medium">Jumlah</label>
                    <input type="number" name="jumlah" class="w-full p-3 border rounded" placeholder="Masukkan jumlah" min="1" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 shadow-md">Tambah ke Keranjang</button>
            </form>

            <!-- Tabel Keranjang -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2">Keranjang Belanja</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border">
                        <thead>
                            <tr class="bg-gray-200 text-center">
                                <th class="border p-2">Barang</th>
                                <th class="border p-2">Harga</th>
                                <th class="border p-2">Jumlah</th>
                                <th class="border p-2">Subtotal</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($keranjang as $id => $item)
                            <tr class="text-center">
                                <td class="border p-2">{{ $item['nama'] }}</td>
                                <td class="border p-2">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="border p-2">{{ $item['jumlah'] }}</td>
                                <td class="border p-2">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                                <td class="border p-2">
                                    <form action="{{ route('kasir.transaksi.hapusBarang', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @php $total += $item['total']; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Pembayaran -->
            <form action="{{ route('kasir.transaksi.prosesTransaksi') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Total Belanja</label>
                    <input type="text" id="totalBelanja" class="w-full p-3 border rounded bg-gray-200" value="{{ $total }}" disabled>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">💵 Uang Pembayaran</label>
                    <input type="number" name="uang_pembayaran" id="uang_pembayaran" class="w-full p-3 border rounded" min="0" placeholder="Masukkan jumlah pembayaran" required>
                    <p id="kembalian" class="mt-2 text-sm font-semibold"></p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">💳 Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="w-full p-3 border rounded" required>
                        <option value="" disabled selected>Pilih metode pembayaran...</option>
                        <option value="cash">💵 Cash</option>
                        <option value="debit">💳 Debit</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white py-3 rounded hover:bg-green-600 shadow-md">Proses Transaksi</button>
            </form>
        </div>
    </div>

    <!-- Script untuk hitung kembalian -->
    <script>
        const totalBelanja = parseInt(document.getElementById('totalBelanja').value);
        const inputUang = document.getElementById('uang_pembayaran');
        const kembalianText = document.getElementById('kembalian');

        inputUang.addEventListener('input', () => {
            const uang = parseInt(inputUang.value) || 0;
            const selisih = uang - totalBelanja;

            if (selisih >= 0) {
                kembalianText.textContent = `✅ Kembalian: Rp ${selisih.toLocaleString('id-ID')}`;
                kembalianText.classList.remove('text-red-600');
                kembalianText.classList.add('text-green-600');
            } else {
                kembalianText.textContent = `⚠️ Kurang: Rp ${(selisih * -1).toLocaleString('id-ID')}`;
                kembalianText.classList.remove('text-green-600');
                kembalianText.classList.add('text-red-600');
            }
        });
    </script>

</body>
</html>
