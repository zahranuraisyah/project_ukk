<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller {
    public function index() {
        $user = Auth::user();
        $detailTransaksis = DetailTransaksi::whereHas('transaksi', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('detail_transaksi.index', compact('detailTransaksis'));
    }
}
