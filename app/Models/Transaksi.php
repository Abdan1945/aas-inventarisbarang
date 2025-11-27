<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'jenis',
        'keterangan',
        'created_by',
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}



