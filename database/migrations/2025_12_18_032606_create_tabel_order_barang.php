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
        Schema::create('tabel_order_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('tabel_order')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('tabel_produk')->onDelete('cascade');
            $table->integer('jumlah_barang');
            $table->float('harga_satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_order_barang');
    }
};
