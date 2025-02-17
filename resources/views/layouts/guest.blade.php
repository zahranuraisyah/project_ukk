<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen flex-col pt-10">
    <h1 class="text-3xl font-bold text-center mb-20">MERCH STORE</h1>
    <div class="w-full max-w-7xl bg-white rounded-lg shadow-lg flex overflow-hidden h-[550px]">
        
        <!-- Bagian Kiri: Welcome & Logo -->
        <div class="w-1/2 flex flex-col items-center justify-center bg-purple-400 text-white p-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-46 mb">
            <h2 class="text-2xl font-semibold">Welcome to Merch Store</h2>
        </div>

        <!-- Bagian Kanan: Form Login -->
        <div class="w-1/2 p-8">
            {{ $slot }}
        </div>

    </div>
</body>

</html>
