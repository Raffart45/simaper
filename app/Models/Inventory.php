<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventoris';
    protected $fillable = [
        'product_id',
        'jumlah',
        'tipe',
        'tanggal',
    ];

    public function product()
    {
        return $this->belongsTo(Produk::class);
    }
}
