<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transaksi', function (Blueprint $table) {
        $table->id('kode_transaksi');
        $table->foreignId('id_pemilik')->nullable()->constrained('users')->onDelete('set null');
        $table->foreignId('id_karyawan')->nullable()->constrained('karyawan')->onDelete('set null');
        $table->foreignId('id_member')->constrained('pelanggan');
        $table->date('tgl_transaksi');
        $table->decimal('total_harga', 10, 2);
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
