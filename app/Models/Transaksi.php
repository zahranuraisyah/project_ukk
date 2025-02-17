<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model {
    use HasFactory;
    
    protected $fillable = [
        'total_harga',
        'uang_pembayaran',
        'uang_kembalian',
        'metode_pembayaran',
        'user_id',
        'tanggal',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detailTransaksi() {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    public function barang() {
        return $this->belongsTo(Barang::class);
    }
    
}
