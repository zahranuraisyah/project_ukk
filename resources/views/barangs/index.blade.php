<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 20rem; /* 80px */
            background-color: #a855f7; /* bg-purple-500 */
            color: white;
            padding: 1.5rem; /* 6px */
            display: flex;
            flex-direction: column;
            gap: 1.5rem; /* 6px */
        }
        .content {
            margin-left: 20rem; /* 80px */
            padding: 1.5rem; /* 6px */
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
                <h2 class="text-lg font-bold">Admin Panel</h2>
            </div>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Dashboard</a>
                <a href="{{ route('barangs.index') }}" class="py-2 text-black px-4 text-lg font-semibold bg-white rounded-md">Products</a>
                <a href="{{ route('admin.pembelian.index') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Restock</a>
                <a href="{{ route('admin.laporan.preview') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Reports</a>
            </nav>
        </aside>
        
        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Daftar Barang</h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 rounded">Logout</button>
                </form>
            </header>
            
            <!-- Main Content -->
            <main class="p-6">

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 p-3 rounded-md mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Dropdown Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-lg font-medium text-gray-700 md-4">Kategori Barang</label>
                    <div class="relative">
                        <select name="kategori" id="kategori" class="w-full border rounded p-2 bg-white focus:ring focus:ring-purple-300 appearance-none" onchange="filterKategori(this)">
                            <option value="">Pilih Kategori</option>
                            <option value="Lightstick">Lightstick</option>
                            <option value="Album">Album</option>
                            <option value="Photocard">Photocard</option>
                            <option value="Gantungan Kunci">Gantungan Kunci</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full text-left">
                        <thead class="bg-purple-300">
                            <tr>
                                <th class="px-4 py-2 text-white">Nama Barang</th>
                                <th class="px-4 py-2 text-white">Harga</th>
                                <th class="px-4 py-2 text-white">Stok</th>
                                <th class="px-4 py-2 text-white">Kategori</th>
                                <th class="px-4 py-2 text-white">Gambar</th>
                                <th class="px-4 py-2 text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr class="barang-row" data-kategori="{{ $barang->kategori }}">
                                    <td class="border px-4 py-2">{{ $barang->nama }}</td>
                                    <td class="border px-4 py-2">Rp{{ number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2">{{ $barang->stok }}</td>
                                    <td class="border px-4 py-2">{{ $barang->kategori }}</td>
                                    <td class="border px-4 py-2">
                                        <img src="{{ $barang->gambar ? asset('storage/' . $barang->gambar) : asset('storage/uploads/no.png') }}" 
                                        alt="Gambar Barang" class="w-20 h-20 object-cover rounded-md shadow-sm">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('barangs.edit', $barang->id) }}" class="text-blue-500">Edit</a> |
                                        <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('barangs.create') }}" class="mt-4 inline-block bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 ">Tambah Barang</a>
            </main>
        </div>
    </div>

    <script>
        function filterKategori(select) {
            const kategori = select.value;
            const rows = document.querySelectorAll('.barang-row');

            rows.forEach(row => {
                const rowKategori = row.getAttribute('data-kategori');
                if (!kategori || rowKategori === kategori) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>