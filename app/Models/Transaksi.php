<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $table = 'transaksis';
    
    protected $fillable = [
        'pesanan_id',
        'no_transaksi',
        'harga_dp',
        'foto_dp',
        'tanggal_dp',
        'cicilan_satu',
        'foto_cicilan_satu',
        'tanggal_cicilan_satu',
        'cicilan_dua',
        'foto_cicilan_dua',
        'tanggal_cicilan_dua',
        'lunas',
        'foto_lunas',
        'tanggal_lunas',
        'status_transaksi',
        'total_bayar'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function return()
    {
        return $this->hasMany(ReturnProduk::class, 'transaction_id');
    }
}
