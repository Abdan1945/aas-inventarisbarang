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
       Schema::create('transaksi', function (Blueprint $table) {
    $table->id();
    $table->string('kode_transaksi')->unique();
    $table->date('tanggal');
    $table->enum('jenis', ['masuk', 'keluar']);
    $table->text('keterangan')->nullable();
    $table->foreignId('created_by')->nullable()->constrained('users');
    $table->timestamps();
});


        // Tabel detail transaksi (pivot)
        Schema::create('transaksi_details', function (Blueprint $table) {
    $table->id();

    $table->foreignId('transaksi_id')
        ->constrained('transaksi')
        ->onDelete('cascade');

    $table->foreignId('barang_id')
        ->constrained('barangs')
        ->onDelete('cascade');

    $table->integer('jumlah');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
        Schema::dropIfExists('transaksis');
    }
};
