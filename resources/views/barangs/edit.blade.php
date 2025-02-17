<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="bg-white text-black shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Edit Barang</h1>
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

            <form action="{{ route('barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <!-- Input nama -->
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" value="{{ $barang->nama }}" required>
                </div>
                
                <!-- Input harga -->
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" id="harga" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" value="{{ $barang->harga }}" required>
                </div>
                
                <!-- Input stok -->
                <div class="mb-4">
                    <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stok" id="stok" class="w-full border rounded p-2 focus:ring focus:ring-purple-300" value="{{ $barang->stok }}" required>
                </div>
                
                <!-- Dropdown kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Barang</label>
                    <div class="relative">
                        <select name="kategori" id="kategori" class="w-full border rounded p-2 bg-white focus:ring focus:ring-purple-300 appearance-none">
                            <option value="">Pilih Kategori</option>
                            <option value="Lightstick" {{ $barang->kategori == 'Lightstick' ? 'selected' : '' }}>Lightstick</option>
                            <option value="Album" {{ $barang->kategori == 'Album' ? 'selected' : '' }}>Album</option>
                            <option value="Photocard" {{ $barang->kategori == 'Photocard' ? 'selected' : '' }}>Photocard</option>
                            <option value="Gantungan Kunci" {{ $barang->kategori == 'Gantungan Kunci' ? 'selected' : '' }}>Gantungan Kunci</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Input file gambar -->
                <div class="mb-4">
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Upload Gambar Baru (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="w-full border rounded p-2 focus:ring focus:ring-purple-300">
                    <p class="text-sm text-gray-500 mt-2">Gambar saat ini:</p>
                    <img src="{{ $barang->gambar ? asset('storage/' . $barang->gambar) : asset('storage/uploads/no.png') }}" 
                        style="width: 200px; height: 200px;"
                        class="object-cover rounded-md shadow-sm">  
                </div>
                
                <!-- Tombol submit -->
                <button type="submit" class="mt-4 px-4 py-2 bg-purple-600 text-white font-bold rounded hover:bg-purple-700 shadow-lg">
                    Update Barang
                </button>            
            </form>
            
            <a href="{{ route('barangs.index') }}" class="mt-4 inline-block text-purple-600 hover:underline">Kembali ke Daftar Barang</a>
        </div>
    </main>
</body>
</html>
