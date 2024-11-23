<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id(); // ID item transaksi (auto-increment)
            $table->unsignedBigInteger('transaction_id'); // Relasi ke tabel transactions
            $table->unsignedBigInteger('product_id'); // Relasi ke tabel products
            $table->string('name'); // Nama produk
            $table->integer('quantity'); // Jumlah produk yang dibeli
            $table->integer('price'); // Harga per unit produk
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key ke tabel transactions
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');

            // Foreign key ke tabel products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_items');
    }
}