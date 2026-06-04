<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Nama tabel di database (pastikan sama dengan di phpMyAdmin)
    protected $table = 'bookings';

protected $fillable = [
    'user_id',
    'kamar_id',
    'nama_lengkap',
    'no_telp',
    'alamat_asal',
    'tanggal_masuk',
    'durasi_sewa',
    'total_biaya',      
    'paket_catering',   
    'durasi_catering',  
    'status_pembayaran',
    'bukti_transfer',
];

    // 1. RELASI KE MODEL KAMAR
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    // 2. RELASI KE MODEL USER (WAJIB ADA agar tidak error saat dipanggil Admin)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}