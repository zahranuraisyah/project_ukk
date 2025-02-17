<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restock Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-80 bg-purple-500 text-white p-6 flex flex-col space-y-6">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
            <h2 class="text-lg font-bold ">Admin Panel</h2>
        </div>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Dashboard</a>
            <a href="{{ route('barangs.index') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Products</a>
            <a href="{{ route('admin.pembelian.index') }}" class="py-2 text-black px-4 text-lg font-semibold bg-white rounded-md">Restock </a>
            <a href="{{ route('admin.laporan.preview') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Reports</a>
        </nav>
    </aside>
    
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Restock Barang</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 rounded">Logout</button>
            </form>
            </header>
        
        <!-- Main Content -->
        <main class="p-6 flex justify-center items-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif
    
                <form action="{{ route('admin.pembelian.store') }}" method="POST">
                    @csrf
                    
                    <!-- Pilih Barang -->
                    <div class="mb-4">
                        <label for="barang_id" class="block text-sm font-medium text-gray-700">Pilih Barang</label>
                        <select name="barang_id" id="barang_id" class="w-full border rounded p-2 bg-white focus:ring focus:ring-purple-300" required>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <!-- Input Jumlah -->
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" min="1" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" required>
                    </div>
    
                    <!-- Input Harga Beli -->
                    <div class="mb-4">
                        <label for="harga_beli" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                        <input type="number" name="harga_beli" id="harga_beli" min="1" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" required>
                    </div>
                    
                    <!-- Tombol Submit -->
                    <button type="submit" class="mt-4 px-4 py-2 bg-purple-600 text-white font-bold rounded hover:bg-purple-700 shadow-lg w-full">
                        Restock Barang
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
