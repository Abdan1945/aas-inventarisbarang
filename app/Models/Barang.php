<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang', 'stok', 'harga_satuan',
    ];

    // Relasi many-to-many dengan KategoriBarang
    public function kategori()
{
    return $this->belongsTo(KategoriBarang::class, 'id_kategori');
}


    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'barang_id');
    }
}
