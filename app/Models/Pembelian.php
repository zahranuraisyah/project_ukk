<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'jumlah', 'harga_beli', 'total_harga', 'tanggal_pembelian'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

