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
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade'); // Relasi dengan transaksi
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Relasi dengan produk
            $table->string('name'); // Nama produk
            $table->integer('quantity'); // Jumlah produk yang dibeli
            $table->integer('price'); // Harga per unit produk
            $table->timestamps(); // Kolom created_at dan updated_at
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