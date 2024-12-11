<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('kode_transaksi');
            $table->foreignId('id_pemilik')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('id_karyawan')->nullable()->constrained('karyawan')->onDelete('set null');
            // Use string instead of foreignId for alphanumeric 'id_member'
            $table->foreignId('id_member')->nullable()->references('id')->on('pelanggan')->onDelete('set null');
            $table->date('tgl_transaksi');
            $table->float('total_harga', 2);
            $table->float('total_pembayaran', 2)->nullable();
            $table->string('nama_pelanggan');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
