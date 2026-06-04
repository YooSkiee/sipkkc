<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // INI DIA KUNCI JAWABANNYA WAK:
    // Mengizinkan semua kolom diisi data, kecuali kolom 'id'
    protected $guarded = ['id'];

    // Relasi ke tabel users (Penyewa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel kamars (Unit Kamar)
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}