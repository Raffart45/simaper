<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $fillable = [
        'user_id',
        'product_id',
        'ongkir_id',
        'no_pesanan',
        'nama_pemesan',
        'no_telp',
        'alamat',
        'kabupaten',
        'provinsi',
        'tanggal_pesananan',
        'jumlah_pesanan',
        'harga_pesanan',
        'status_pesanan',
    ];

    protected $dates = [
        'tanggal_pesananan',
    ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function product()
        {
            return $this->belongsTo(Produk::class, 'product_id');
        }

        public function ongkir()
        {
            return $this->belongsTo(Ongkir::class);
        }

        public function transaksi()
        {
            return $this->hasOne(Transaksi::class, 'pesanan_id');
        }
}
