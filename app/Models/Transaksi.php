<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'id_barang',
        'tanggal',
        'total_harga',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function kategoris()
    {
        return $this->belongsToMany(
            Kategoribarang::class,
            'detail_transaksi',
            'id_transaksi',
            'id_kategori'
        )->withPivot('jumlah', 'sub_total')
         ->withTimestamps();
    }
}
