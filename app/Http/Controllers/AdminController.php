<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Catering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Ulasan;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $total_kamar = Kamar::count();
        $kamar_tersedia = Kamar::where('status_kamar', 'Tersedia')->count();
        $pesanan_pending = Booking::where('status_pembayaran', 'Pending')->count(); 
        
        // Menghitung total pendapatan dari pesanan Lunas
        $total_pendapatan = Booking::where('status_pembayaran', 'Lunas')->sum('total_biaya');

        // Ambil data terbaru dengan relasi agar view tidak error
        $recent_bookings = Booking::with(['user', 'kamar'])->latest()->take(5)->get();
        $kamars = Kamar::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'total_kamar', 
            'pesanan_pending', 
            'kamar_tersedia', 
            'total_pendapatan', 
            'kamars', 
            'recent_bookings'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN KAMAR
    |--------------------------------------------------------------------------
    */
    public function kamarIndex() 
    {
        $kamars = Kamar::latest()->get(); 
        return view('admin.kamar.index', compact('kamars'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'no_kamar' => 'required|unique:kamars,no_kamar|max:10',
            'tipe_kamar' => 'required|string',
            'harga_kamar' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
        ]);

        Kamar::create([
            'no_kamar' => $request->no_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_kamar' => $request->harga_kamar,
            'fasilitas' => $request->fasilitas,
            'status_kamar' => 'Tersedia',
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar #'.$request->no_kamar.' berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('admin.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi HANYA data yang dikirim dari form
        $request->validate([
            'no_kamar' => 'required|max:10|unique:kamars,no_kamar,' . $id,
            'status_kamar' => 'required|in:Tersedia,Terisi,Perbaikan',
            'harga_kamar' => 'required|numeric',
        ]);

        $kamar = Kamar::findOrFail($id);
        
        // 2. Simpan perubahannya
        $kamar->update([
            'no_kamar' => $request->no_kamar,
            'status_kamar' => $request->status_kamar,
            'harga_kamar' => $request->harga_kamar,
        ]);

        // 3. Langsung tutup form dan kembali ke halaman utama (Index)
        return redirect()->route('admin.kamar.index')->with('success', 'Data Kamar berhasil diperbarui!');
    }

    public function kamarDestroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        
        if($kamar->status_kamar == 'Terisi') {
            return back()->with('error', 'Kamar tidak bisa dihapus karena sedang terisi!');
        }

        $kamar->delete();
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }

    public function create()
    {
        // Menampilkan halaman form untuk menambah kamar baru
        return view('admin.kamar.create'); 
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN BOOKING (Pesanan)
    |--------------------------------------------------------------------------
    */
    public function indexBooking()
    {
        // Tetap menggunakan eager loading 'user' agar nama penyewa tampil aman
        $bookings = Booking::with(['kamar', 'user'])->latest()->get();
        return view('admin.pesanan.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Jika Lunas, update status booking dan kamar sekaligus
        if ($request->status == 'Lunas') {
            $booking->update(['status_pembayaran' => 'Lunas']);
            
            // Cek jika relasi kamar ada untuk menghindari error
            if ($booking->kamar) {
                $booking->kamar->update(['status_kamar' => 'Terisi']);
            }
        } else {
            $booking->update(['status_pembayaran' => 'Ditolak']);
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN CATERING
    |--------------------------------------------------------------------------
    */
    public function cateringIndex() 
    {
        $caterings = Catering::latest()->get();

        // Ambil pemesan catering yang sudah lunas
        $pemesan = Booking::with(['user', 'kamar'])
                    ->whereNotNull('paket_catering')
                    ->where('status_pembayaran', 'Lunas')
                    ->latest()
                    ->get();

        return view('admin.catering.index', compact('caterings', 'pemesan'));
    }

    public function cateringStore(Request $request) 
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'hari'      => 'required|string',
            'harga'     => 'required|numeric', // Harus angka murni
            'deskripsi' => 'nullable|string',
        ]);

        // 2. Simpan manual satu per satu (Anti-Gagal)
        $catering = new \App\Models\Catering();
        $catering->nama_menu = $request->nama_menu;
        $catering->hari      = $request->hari;
        $catering->harga     = $request->harga;
        $catering->deskripsi = $request->deskripsi;
        $catering->save();

        // 3. Redirect (Beralih) kembali ke halaman utama catering
        return redirect()->route('admin.catering.index')->with('success', 'Menu baru berhasil ditambahkan!');
    }
    
    public function cateringDestroy($id) 
    {
        $menu = Catering::findOrFail($id);
        $menu->delete();
        return redirect()->back()->with('success', 'Menu berhasil dihapus.');
    }
    
    public function cateringCreate()
    {
        // Ini mengarahkan ke file view form tambah catering
        // Sesuaikan lokasi filenya dengan punyamu, misal: admin.catering.create
        return view('admin.catering.create');
    }

    /*
    |--------------------------------------------------------------------------
    | ---> KODE BARU: MANAJEMEN ULASAN <---
    |--------------------------------------------------------------------------
    */
    
    /**
     * Menampilkan daftar ulasan untuk Admin
     */
    public function ulasanIndex()
    {
        // Mengambil semua ulasan beserta relasi user dan kamarnya, urut dari yang terbaru
        $ulasans = Ulasan::with(['user', 'kamar'])->latest()->get();
        
        return view('admin.ulasan', compact('ulasans'));
    }
}