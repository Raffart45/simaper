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
        Schema::create('return_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transaksis'); // Relasi ke tabel transaksi
            $table->integer('jumlah'); // Jumlah barang yang dikembalikan
            $table->date('tanggal'); // Tanggal pengembalian
            $table->text('alasan')->nullable(); // Alasan pengembalian
            $table->string('foto_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_produks');
    }
};
