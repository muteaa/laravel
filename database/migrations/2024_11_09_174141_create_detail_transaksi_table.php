<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            // Primary key for this table
            $table->id();

            // Foreign key to transaksi (primary key from transaksi table)
            $table->unsignedBigInteger('kode_transaksi');
            $table->foreign('kode_transaksi')->references('kode_transaksi')->on('transaksi')->onDelete('cascade');

            // Foreign key to produk (primary key from produk table)
            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');

            // Additional fields
            $table->unsignedInteger('jumlah_produk');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
