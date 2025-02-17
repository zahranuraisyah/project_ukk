<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-80 bg-purple-500 text-white p-6 flex flex-col space-y-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
                <h2 class="text-lg font-bold ">Admin Panel</h2>
            </div>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="py-2 text-black px-4 font-semibold bg-white rounded-md">Dashboard</a>
                <a href="{{ route('barangs.index') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Products</a>
                <a href="{{ route('admin.pembelian.index') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Restock </a>
                <a href="{{ route('admin.laporan.preview') }}" class="py-2 px-4 hover:bg-purple-700 text-lg rounded-md">Reports</a>
            </nav>
        </aside>
        
        <!-- Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Dashboard</h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 rounded">Logout</button>
                </form>
            </header>
            
            <!-- Main Content -->
            <main class="p-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold">Selamat datang di Dashboard!</h2>
                    <p class="text-gray-600 mt-2">Ini adalah area utama untuk mengelola toko.</p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>