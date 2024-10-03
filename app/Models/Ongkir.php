<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;


    // Tentukan nama tabel yang digunakan oleh model ini
    protected $table = 'ongkirs';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'kabupaten',
        'provinsi',
        'harga_ongkir',
    ];

    // Jika Anda menggunakan timestamp, Anda bisa mengatur ini sesuai kebutuhan
    public $timestamps = true;
}
