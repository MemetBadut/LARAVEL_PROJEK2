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
        Schema::create('tabel_keranjang_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keranjang_id')->constrained('tabel_keranjang')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('tabel_produk')->onDelete('cascade');
            $table->integer('jumlah_produk');
            $table->float('subtotal_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_keranjang_produk');
    }
};
