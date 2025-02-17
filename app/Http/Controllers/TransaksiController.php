<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksis = Transaksi::with('user', 'detailTransaksi.barang')->get();
        return view('kasir.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $keranjang = session()->get('keranjang', []);
        return view('kasir.transaksi.create', compact('barangs', 'keranjang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);
        

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->withErrors(['error' => 'Stok barang tidak mencukupi.']);
        }

        $totalHarga = $barang->harga * $request->jumlah;

        Transaksi::create([
            'barang_id' => $barang->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'user_id' => Auth::id(),
        ]);

        $barang->decrement('stok', $request->jumlah);

        return redirect()->route('kasir.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('kasir.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function tambahKeranjang(Request $request)
    {
        $request->validate(['barang_id' => 'required|exists:barangs,id', 'jumlah' => 'required|integer|min:1']);

        $barang = Barang::find($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->withErrors(['error' => 'Stok barang tidak mencukupi.']);
        }

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$barang->id])) {
            $keranjang[$barang->id]['jumlah'] += $request->jumlah;
            $keranjang[$barang->id]['total'] += $barang->harga * $request->jumlah;
        } else {
            $keranjang[$barang->id] = [
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'jumlah' => $request->jumlah,
                'total' => $barang->harga * $request->jumlah,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Barang ditambahkan ke keranjang.');
    }

    public function prosesTransaksi(Request $request)
    {

        // dd($request->all());
        // Validasi input untuk memastikan data benar
        $request->validate([
            'uang_pembayaran' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required',
        ]);

        // Mengambil data keranjang dari session
        $keranjang = session('keranjang', []);
        
        if (empty($keranjang)) {
            return redirect()->back()->withErrors('Keranjang masih kosong!');
        }
        
        // Menghitung total bayar dari semua item di keranjang
        $totalBayar = array_sum(array_column($keranjang, 'total'));
        $uangPembayaran = $request->input('uang_pembayaran');
        
        // Mengecek apakah uang pembayaran mencukupi
        if ($uangPembayaran < $totalBayar) {
            return redirect()->back()->withErrors('Uang pembayaran kurang!');
        }

        // Menyimpan data transaksi ke database
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'total_harga' => $totalBayar,
            'uang_pembayaran' => $uangPembayaran,
            'uang_kembalian' => $uangPembayaran - $totalBayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal' => now(),
     
        ]);

        // Menyimpan detail transaksi untuk setiap barang di keranjang
        foreach ($keranjang as $index => $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $index,
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga'],
                'subtotal' => $item['total'],
            ]);

            // Mengurangi stok barang setelah transaksi berhasil
            $barang = Barang::find($index);
            if ($barang) {
                $barang->stok -= $item['jumlah'];
                $barang->save();
            }
        }

        // Menghapus session keranjang setelah transaksi selesai
        session()->forget('keranjang');

        // Mengarahkan ke halaman detail transaksi setelah sukses
        return redirect()->route('kasir.transaksi.detail', $transaksi->id)->with('kembalian', $uangPembayaran - $totalBayar);
    }

    public function resetKeranjang()
    {
        session()->forget('keranjang');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function hapusBarang($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }

    public function riwayat()
    {
        $transaksis = Transaksi::with('detailTransaksi.barang')->orderBy('created_at', 'desc')->get();
        return view('kasir.transaksi.riwayat', compact('transaksis'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.barang')->findOrFail($id);
        return view('kasir.transaksi.detail', compact('transaksi'));
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.barang')->findOrFail($id);
        return view('kasir.transaksi.detail', compact('transaksi'));
    }

}
