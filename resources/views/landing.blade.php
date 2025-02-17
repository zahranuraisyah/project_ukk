<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Kasir Merchandise</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="fixed top-0 left-0 w-full bg-black/30 backdrop-blur-md text-white py-4 px-8 flex justify-between items-center z-50">
        <div class="text-2xl font-bold">Merch Store</div>
        <div class="space-x-2">
            <a href="/login" class="px-4 py-2 bg-pruple-500 text-white rounded-lg hover:bg-purple-600">Login</a>
            <a href="/register" class="px-4 py-2 bg-pruple-500 text-white rounded-lg hover:bg-purple-600">Register</a>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('/images/bts.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        <div class="relative z-10 text-white">
            <h1 class="text-5xl font-extrabold">Selamat Datang di Toko Merchandise</h1>
            <p class="mt-4 text-lg">Temukan koleksi merchandise K-Pop terbaik di sini!</p>
        </div>
    </section>
</body>
</html>
