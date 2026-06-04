<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    // Menampilkan halaman form ulasan untuk penyewa
public function create()
    {
        $riwayat_kamar = \App\Models\Booking::where('user_id', auth()->user()->id)
                            ->with('kamar') // Pastikan ada relasi 'kamar' di model Booking kamu
                            ->get()
                            ->unique('kamar_id'); // Biar kalau dia sewa kamar yang sama 2x, munculnya cuma 1

        return view('penyewa.ulasan', compact('riwayat_kamar'));
    }

    // Menyimpan data ulasan ke database
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        Ulasan::create([
            'user_id' => Auth::id(), // Mengambil ID user yang sedang login
            'kamar_id' => $request->kamar_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}