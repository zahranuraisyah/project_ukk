<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Pembelian;

class PembelianController extends Controller
{
    // Menampilkan halaman riwayat pembelian
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.pembelian.index', compact('barangs'));
    }

    // Proses restock barang
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
        ]);

        // Ambil barang
        $barang = Barang::findOrFail($request->barang_id);

        // Hitung total harga beli
        $total_harga = $request->jumlah * $request->harga_beli;

        // Simpan data pembelian
        Pembelian::create([
            'barang_id' => $barang->id,
            'jumlah' => $request->jumlah,
            'harga_beli' => $request->harga_beli,
            'total_harga' => $total_harga,
            'tanggal_pembelian' => now(),
        ]);

        // Update stok barang
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->back()->with('success', 'Restock barang berhasil!');
    }
}

