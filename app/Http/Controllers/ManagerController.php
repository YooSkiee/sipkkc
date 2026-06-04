<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ulasan;

class ManagerController extends Controller
{
    public function dashboard()
    {
        // 1. STATISTIK UTAMA
        $total_pendapatan = Booking::where('status_pembayaran', 'Lunas')->sum('total_biaya');
        $okupansi = Kamar::where('status_kamar', 'Terisi')->count();
        $total_kamar = Kamar::count();
        
        // Hitung persentase okupansi untuk progress bar
        $persen_okupansi = ($total_kamar > 0) ? ($okupansi / $total_kamar) * 100 : 0;

        // 2. HITUNG PELANGGAN CATERING AKTIF (Fix Bug Angka 0)
        $total_catering = Booking::where('status_pembayaran', 'Lunas')
                            ->whereNotNull('paket_catering')
                            ->where('paket_catering', '!=', 'Tanpa Catering')
                            ->count();

        // 3. DATA GRAFIK PENDAPATAN (Tahun 2026)
        $monthly_data = Booking::select(
                DB::raw('SUM(total_biaya) as total'),
                DB::raw("DATE_FORMAT(created_at, '%M') as bulan")
            )
            ->where('status_pembayaran', 'Lunas')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('created_at', 'ASC')
            ->get();

        $labels = $monthly_data->pluck('bulan');
        $totals = $monthly_data->pluck('total');

        // 4. KIRIM SEMUA DATA KE VIEW
        return view('manager.dashboard', compact(
            'total_pendapatan', 
            'okupansi', 
            'total_kamar', 
            'persen_okupansi',
            'labels',
            'totals',
            'total_catering'
        ));
    }

    public function cetakLaporan()
    {
    $total_pendapatan = Booking::where('status_pembayaran', 'Lunas')->sum('total_biaya');
    
    // Ambil semua riwayat lunas
    $riwayat = Booking::with(['kamar', 'user'])->where('status_pembayaran', 'Lunas')->latest()->get();

    // AMBIL DATA KHUSUS PELANGGAN CATERING AKTIF
    $data_catering = Booking::with('user')
                        ->where('status_pembayaran', 'Lunas')
                        ->whereNotNull('paket_catering')
                        ->where('paket_catering', '!=', 'Tanpa Catering')
                        ->get();

    $tgl_cetak = now()->translatedFormat('d F Y H:i');

    return view('manager.cetak', compact('total_pendapatan', 'riwayat', 'data_catering', 'tgl_cetak'));
    }
    // Tampilkan Form Edit Admin
    public function editAdmin()
    {
        // Cari user yang role-nya 'admin' (Ambil yang pertama kali ketemu)
        $admin = \App\Models\User::where('role', 'admin')->first();

        // Kalau misalnya data admin belum ada di database, kita amankan
        if (!$admin) {
            return redirect()->back()->with('error', 'Data akun Admin tidak ditemukan di sistem.');
        }

        return view('manager.edit_admin', compact('admin'));
    }

    // Proses Update Data Admin
    public function updateAdmin(\Illuminate\Http\Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'admin_id' => 'required|exists:users,id',
            // Pastikan email unik, TAPI kecualikan email milik admin itu sendiri
            'email'    => 'required|email|unique:users,email,' . $request->admin_id,
            // Password sifatnya 'nullable' (kalau dikosongin berarti cuma ganti email)
            'password' => 'nullable|min:8|confirmed', 
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak cocok!',
            'password.min' => 'Password minimal harus 8 karakter!'
        ]);

        // 2. Tarik data admin
        $admin = \App\Models\User::findOrFail($request->admin_id);
        
        // 3. Update Email
        $admin->email = $request->email;

        // 4. Update Password (Hanya jika kolom password diisi)
        if ($request->filled('password')) {
            $admin->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Kredensial akun Admin berhasil diperbarui!');
    }
    public function ulasanIndex()
    {
        // Mengambil semua ulasan beserta relasi user dan kamarnya, urut dari yang terbaru
        $ulasans = Ulasan::with(['user', 'kamar'])->latest()->get();
        
        return view('manager.ulasan', compact('ulasans'));
    }
}