<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-80 bg-purple-500 text-white min-h-screen p-6 fixed flex flex-col space-y-6">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
            <h2 class="text-lg font-bold ">Admin Panel</h2>
        </div>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Dashboard</a>
            <a href="{{ route('barangs.index') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Producs</a>
            <a href="{{ route('admin.pembelian.index') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Restock</a>
            <a href="{{ route('admin.laporan.preview') }}" class="py-2 text-black px-4 text-lg font-semibold bg-white rounded-md">Reports</a>
        </nav>
    </aside>
    
    <div class="flex-1 ml-80">
        <!-- Navbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Generate Laporan</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 rounded">Logout</button>
            </form>
        </header>
        
        <!-- Main Content -->
        <main class="p-6">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl mx-auto">
                <form action="{{ route('admin.laporan.preview') }}" method="GET" class="mb-6">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Pilih Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" required>
                    <button type="submit" class="mt-4 px-4 py-2 bg-purple-600 text-white font-bold rounded hover:bg-purple-700 shadow-lg w-full">
                        Tampilkan Laporan
                    </button>
                </form>
                
                @if (isset($transaksi) && isset($pembelian))
                    <h2 class="text-xl font-bold mb-2">Laporan Transaksi - {{ $tanggal }}</h2>
                    <table class="w-full border-collapse border border-gray-300 mb-6">
                        <tr class="bg-purple-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Total Harga</th>
                            <th class="border p-2">Tanggal Transaksi</th>
                        </tr>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td class="border p-2">{{ $t->id }}</td>
                                <td class="border p-2">{{ $t->total_harga }}</td>
                                <td class="border p-2">{{ $t->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <h2 class="text-xl font-bold mb-2">Laporan Restock - {{ $tanggal }}</h2>
                    <table class="w-full border-collapse border border-gray-300 mb-6">
                        <tr class="bg-purple-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Barang</th>
                            <th class="border p-2">Jumlah</th>
                            <th class="border p-2">Harga Beli</th>
                            <th class="border p-2">Tanggal Restock</th>
                        </tr>
                        @foreach ($pembelian as $p)
                            <tr>
                                <td class="border p-2">{{ $p->id }}</td>
                                <td class="border p-2">{{ $p->barang->nama }}</td>
                                <td class="border p-2">{{ $p->jumlah }}</td>
                                <td class="border p-2">{{ $p->harga_beli }}</td>
                                <td class="border p-2">{{ $p->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <h2 class="text-xl font-bold mb-2">Stok Barang Saat Ini</h2>
                    <table class="w-full border-collapse border border-gray-300 mb-6">
                        <tr class="bg-purple-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nama Barang</th>
                            <th class="border p-2">Stok</th>
                            <th class="border p-2">Harga</th>
                        </tr>
                        @foreach ($stok as $s)
                            <tr>
                                <td class="border p-2">{{ $s->id }}</td>
                                <td class="border p-2">{{ $s->nama }}</td>
                                <td class="border p-2">{{ $s->stok }}</td>
                                <td class="border p-2">{{ $s->harga }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <a href="{{ route('admin.laporan.download', ['tanggal' => $tanggal]) }}" class="block text-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 shadow-lg">Download PDF</a>
                @endif
            </div>
        </main>
    </div>
</body>
</html>
