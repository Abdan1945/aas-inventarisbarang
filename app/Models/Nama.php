<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nama extends Model
{
    use HasFactory;

    protected $table = 'namas'; // optional kalau tabelnya namas
    protected $fillable = ['name', 'email', 'password'];
}
