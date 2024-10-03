<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'jumlah',
        'tanggal',
        'alasan',
        'foto_produk',
        'status'
    ];

    /**
     * Get the transaction that owns the return.
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id');
    }
}
