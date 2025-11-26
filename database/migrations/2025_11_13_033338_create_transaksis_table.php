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
        // Tabel transaksi utama
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('id_barang')->constrained('barangs')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('total_harga');
            $table->timestamps();
        });

        // Tabel detail transaksi (pivot)
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_transaksi')
                ->constrained('transaksis')
                ->onDelete('cascade');

            $table->foreignId('id_kategori')
                ->constrained('kategoribarangs') // <- PERBAIKAN: tabel kategori kamu adalah "kategoribarangs"
                ->onDelete('cascade');

            $table->integer('jumlah');
            $table->integer('sub_total');

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
