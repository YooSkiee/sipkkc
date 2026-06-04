<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['no_kamar', 'tipe_kamar', 'harga_kamar', 'fasilitas', 'status_kamar'];
    
    // Relasi ke tabel ulasans
    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }
}

