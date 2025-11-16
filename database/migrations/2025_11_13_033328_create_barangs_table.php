<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');

            // Relasi kategori (harus sesuai nama tabel: kategori_barangs)
            $table->foreignId('kategori_id')
                ->constrained('kategori_barangs')
                ->onDelete('cascade');

            $table->integer('stok')->default(0);
            $table->decimal('harga_satuan', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
