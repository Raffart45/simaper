<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products'); // Relasi ke tabel products
            $table->integer('jumlah'); // Jumlah stok yang masuk atau keluar
            $table->enum('tipe', ['masuk', 'keluar']); // Tipe transaksi stok
            $table->date('tanggal'); // Tanggal masuk atau keluar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventoris');
    }
};
