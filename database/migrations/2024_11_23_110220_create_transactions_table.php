<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // ID transaksi (auto-increment)
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->dateTime('transaction_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Tanggal dan waktu transaksi
            $table->integer('total_price'); // Total harga transaksi (number, no decimal)
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}