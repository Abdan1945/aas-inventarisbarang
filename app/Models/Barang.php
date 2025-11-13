<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'stok', 'kategori_id', 'harga_satuan'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'barang_id');
    }
}
