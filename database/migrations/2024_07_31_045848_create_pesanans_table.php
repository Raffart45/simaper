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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('ongkir_id')->constrained('ongkirs')->nullable();
            $table->string('no_pesanan');
            $table->string('nama_pemesan');
            $table->string('no_telp');
            $table->text('alamat');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->date('tanggal_pesananan')->nullable();
            $table->string('jumlah_pesanan');
            $table->decimal('harga_pesanan', 10, 2);
            $table->string('status_pesanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
