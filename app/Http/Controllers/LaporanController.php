<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Pembelian;
use App\Models\Barang;

class LaporanController extends Controller
{
    // Menampilkan halaman laporan
    public function index()
    {
        return view('admin.laporan');
    }

    // Generate PDF berdasarkan filter tanggal
    public function generatePDF(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil transaksi berdasarkan filter tanggal
        $transaksi = Transaksi::whereBetween('tanggal', [$request->start_date, $request->end_date])->get();

        // Kirim data ke view laporan
        $pdf = Pdf::loadView('admin.laporan_pdf', compact('transaksi'));

        // Download PDF
        return $pdf->download('laporan-transaksi.pdf');
    }

    public function previewLaporan(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $transaksi = Transaksi::with('barang')->whereDate('tanggal', $tanggal)->get();
        $pembelian = Pembelian::with('barang')
        ->whereDate('created_at', $tanggal)
        ->get();   
        $stok = Barang::all(); // Stok tetap ambil semua

        return view('admin.laporan_preview', compact('transaksi', 'pembelian', 'stok', 'tanggal'));
    }

    public function downloadLaporan(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $transaksi = Transaksi::whereDate('tanggal', $tanggal)->get();
        $pembelian = Pembelian::whereDate('created_at', $tanggal)->get();
        $stok = Barang::all();

        $pdf = Pdf::loadView('admin.laporan_pdf', compact('transaksi', 'pembelian', 'stok', 'tanggal'));

        return $pdf->download('laporan_' . $tanggal . '.pdf');
    }
        
}
