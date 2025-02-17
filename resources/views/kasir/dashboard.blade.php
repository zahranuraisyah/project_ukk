<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-80 bg-purple-500 text-white min-h-screen p-6 fixed flex flex-col space-y-6">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
            <h2 class="text-lg font-bold ">Kasir </h2>
        </div>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('kasir.dashboard') }}" class="py-2 text-black px-4 font-semibold bg-white rounded-md">Dashboard</a>
            <a href="{{ route('kasir.transaksi.create') }}" class="py-2 px-4 hover:bg-purple-700 rounded-md">New Transaction</a>
            <a href="{{ route('kasir.transaksi.riwayat') }}" class="py-2 px-4 hover:bg-purple-700 rounded-md">Transaction History</a>
        </nav>
    </aside>
    
    <div class="flex-1 ml-80 p-6">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition text-white px-4 py-2 rounded">Logout</button>
            </form>
        </header>
        
        <!-- Main Content Kosong -->
        <main class="p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold">Selamat datang di Dashboard Kasir!</h2>
                <p class="text-gray-600 mt-2">Ini adalah area utama untuk menambah transaksii.</p>
            </div>
        </main>
    </div>
</body>
</html>
