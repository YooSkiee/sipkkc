<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    use HasFactory;

    // Tambahkan ini agar Laravel mengizinkan input data
    protected $fillable = [
        'nama_menu',
        'harga',
        'deskripsi',
        'hari'
    ];
}