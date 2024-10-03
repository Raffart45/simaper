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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans');
            $table->string('no_transaksi');
            $table->string('harga_dp');
            $table->string('foto_dp');
            $table->string('tanggal_dp');
            $table->string('total_bayar');
            $table->string('lunas')->nullable();
            $table->string('foto_lunas')->nullable();
            $table->date('tanggal_lunas')->nullable();
            $table->string('status_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
