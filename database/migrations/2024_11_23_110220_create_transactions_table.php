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
            $table->foreignId('user_id')->constrained(); // Menghubungkan dengan tabel users
            $table->enum('status', ['pending', 'completed']);
            $table->timestamp('transaction_date')->useCurrent(); // Tanggal transaksi
            $table->integer('total_price'); // Total harga transaksi (number, no decimal)
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
        Schema::dropIfExists('transactions');
    }
}