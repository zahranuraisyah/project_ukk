<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="bg-white text-black shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Tambah Barang</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 rounded">Logout</button>
        </form>
    </header>
    
    <!-- Main Content -->
    <main class="p-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-3 rounded-md mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Input nama -->
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" required>
                </div>
                
                <!-- Input harga -->
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" id="harga" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" required>
                </div>
                
                <!-- Input stok -->
                <div class="mb-4">
                    <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stok" id="stok" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" required>
                </div>
                
                <!-- Dropdown kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Barang</label>
                    <select name="kategori" id="kategori" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Lightstick">Lightstick</option>
                        <option value="Album">Album</option>
                        <option value="Photocard">Photocard</option>
                        <option value="Gantungan Kunci">Gantungan Kunci</option>
                    </select>
                </div>
                
                <!-- Input file gambar -->
                <div class="mb-4">
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Upload Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="w-full border rounded p-2 focus:ring focus:ring-purple-300">
                </div>
                
                <!-- Tombol submit -->
                <button type="submit" class="mt-4 px-4 py-2 bg-purple-600 text-white font-bold rounded hover:bg-purple-700 shadow-lg">
                    Tambah Barang
                </button>            
            </form>
            
            <a href="{{ route('barangs.index') }}" class="mt-4 inline-block text-purple-600 hover:underline">Kembali ke Daftar Barang</a>
        </div>
    </main>
</body>
</html>
