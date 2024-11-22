<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID produk (auto increment)
            $table->enum('kategori_produk', ['daging segar', 'daging olahan']); // Dropdown enum
            $table->enum('kategori_daging', ['daging merah', 'daging putih']); // Dropdown enum
            $table->string('nama_produk'); // Nama produk
            $table->integer('harga_produk'); // Harga (number, no decimal)
            $table->integer('jumlah_stok'); // Stok produk
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
