@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Generate Laporan Transaksi</h2>

    <form action="{{ route('admin.laporan.generate') }}" method="GET">
        @csrf
        <label for="start_date">Tanggal Mulai:</label>
        <input type="date" name="start_date" required>
        
        <label for="end_date">Tanggal Akhir:</label>
        <input type="date" name="end_date" required>

        <button type="submit">Generate Laporan</button>
    </form>
</div>
@endsection
