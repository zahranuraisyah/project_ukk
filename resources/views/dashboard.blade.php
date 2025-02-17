<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat datang di Dashboard</h1>
    <p>Halo, {{ auth()->user()->name }}! Role kamu adalah <strong>{{ auth()->user()->role }}</strong>.</p>

    @if(auth()->user()->role === 'admin')
        <p><a href="/admin">Masuk ke Admin Panel</a></p>
    @endif

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
