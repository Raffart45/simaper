<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'nama_produk',
        'stok',
        'category',
        'foto_produk',
        'deskripsi',
        'harga',
        'thumbnails', 
        'berat',
        'box'
    ];
    protected $casts = [
        'thumbnails' => 'array',
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'product_id');
    }
}
