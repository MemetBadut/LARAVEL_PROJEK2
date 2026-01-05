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
        Schema::create('tabel_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('tabel_vendor')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_produk')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('slug')->unique();
            $table->float('harga_produk');
            $table->integer('stok_produk');
            $table->text('deskripsi_produk');
            $table->string('gambar')->nullable();
            $table->enum('status_produk', ['tersedia', 'tersimpan','habis'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
