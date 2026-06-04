<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyewaController extends Controller
{
    /**
     * Halaman Welcome
     */
    public function welcome()
    {
        return view('penyewa.welcome');
    }

    /**
     * Katalog Kamar
     */
    public function menuKamar()
    {
        // KODE YANG DIUPDATE:
        // Ambil data kamar beserta rata-rata rating, jumlah ulasan, dan ulasan terbarunya
        $kamar = Kamar::with(['ulasans' => function($query) {
                $query->latest()->with('user'); // Ambil ulasan terbaru beserta data user-nya
            }])
            ->withAvg('ulasans', 'rating')   // Menghitung rata-rata rating otomatis
            ->withCount('ulasans')           // Menghitung total jumlah ulasan otomatis
            ->orderBy('no_kamar', 'asc')     // Urutkan berdasarkan nomor kamar
            ->get(); 
            
        $tipe = "Semua Tipe";

        // Pastikan nama view ini sesuai dengan nama file blade kamu (menu_kamar.blade.php)
        return view('penyewa.menu_kamar', compact('kamar', 'tipe'));
    }

    /**
     * Form Booking Kamar (Step 1)
     */
    public function showBookingForm($kamar_id)
    {
        $kamar = Kamar::findOrFail($kamar_id);
        return view('penyewa.booking_form', compact('kamar'));
    }

    /**
     * Simpan Booking Kamar (Step 1 Proses)
     */
    public function storeBooking(Request $request)
    {
        $request->validate([
            'kamar_id'      => 'required',
            'nama_lengkap'  => 'required',
            'no_telp'       => 'required',
            'alamat_asal'   => 'required',
            'tanggal_masuk' => 'required|date',
            'durasi_sewa'   => 'required|integer|min:1',
        ]);

        $kamar = Kamar::findOrFail($request->kamar_id);
        $total_biaya = $kamar->harga_kamar * $request->durasi_sewa;

        $booking = Booking::create([
            'user_id'           => auth()->id(),
            'kamar_id'          => $request->kamar_id,
            'nama_lengkap'      => $request->nama_lengkap,
            'no_telp'           => $request->no_telp,
            'alamat_asal'       => $request->alamat_asal,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'durasi_sewa'       => $request->durasi_sewa,
            'total_biaya'       => $total_biaya,
            'status_pembayaran' => 'Pending',
        ]);

        return redirect()->route('penyewa.booking.catering', $booking->id)
                         ->with('success', 'Data booking disimpan. Silakan pilih paket catering.');
    }

    /**
     * Tampilan Pilihan Catering (Step 2)
     */
    public function showCatering($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Data menu statis
        $menuPaket1 = [
            'Senin' => ['Pagi: Orak-arik Telur Sayuran', 'Siang: Ayam Goreng Lengkuas + Sayur Asem', 'Malam: Tempe Mendoan + Tumis Kacang Panjang'],
            'Selasa' => ['Pagi: Tahu Telur Bumbu Kacang', 'Siang: Ikan Tongkol Suwir + Tumis Sawi Putih', 'Malam: Bakwan Jagung + Sayur Bening Bayam'],
            'Rabu' => ['Pagi: Telur Dadar Padang', 'Siang: Semur Ayam & Kentang + Tumis Buncis', 'Malam: Tahu Goreng Kuning + Sayur Lodeh Jawa'],
            'Kamis' => ['Pagi: Oreg Tempe Teri Kacang', 'Siang: Ayam Bakar Kecap + Cah Kangkung', 'Malam: Perkedel Kentang + Sop Sayuran'],
            'Jumat' => ['Pagi: Telur Ceplok Balado', 'Siang: Ikan Lele Goreng + Sayur Labu Siam', 'Malam: Tahu Isi Sayur + Tumis Tauge Jambal'],
            'Sabtu' => ['Pagi: Mie Goreng Jawa', 'Siang: Ayam Krispi Geprek + Sayur Urap', 'Malam: Tempe Bacem + Sayur Bobor'],
            'Minggu' => ['Pagi: Telur Rebus Pindang', 'Siang: Gulai Ayam + Daun Singkong Rebus', 'Malam: Tahu Krispi + Sambal Goreng Kentang'],
        ];

        $menuPaket2 = [
            'Senin' => ['Pagi: Telur Dadar Sayur + Sambal Korek', 'Siang: Ayam Bakar Taliwang + Plencing Kangkung', 'Malam: Tempe Goreng Tepung + Sayur Asem'],
            'Selasa' => ['Pagi: Orak-arik Telur, Sosis & Buncis', 'Siang: Ikan Nila Goreng + Sayur Lodeh Komplit', 'Malam: Bakwan Jagung + Tumis Sawi Hijau'],
            'Rabu' => ['Pagi: Tahu Masak Kecap (Tahu Becek)', 'Siang: Rendang Ayam + Daun Singkong & Sambal Ijo', 'Malam: Telur Ceplok Air (Pindang) + Benir Bayam'],
            'Kamis' => ['Pagi: Telur Balado Petai', 'Siang: Empal Gentong Ayam + Kerupuk Udang', 'Malam: Perkedel Kentang + Tumis Buncis & Bakso'],
            'Jumat' => ['Pagi: Ati Ampela Goreng Ketumbar', 'Siang: Ikan Patin Asam Pedas + Cah Sawi Putih', 'Malam: Tahu Bacem + Sayur Sop Bakso'],
            'Sabtu' => ['Pagi: Mie Goreng Ayam & Bakso', 'Siang: Ayam Goreng Mentega + Capcay Seafood', 'Malam: Tempe Mendoan + Sayur Bobor Bayam'],
            'Minggu' => ['Pagi: Telur Dadar Keju / Omelet', 'Siang: Daging Sapi Lada Hitam + Tumis Brokoli', 'Malam: Tahu Krispi + Sayur Asem Jakarta'],
        ];

        return view('penyewa.booking.catering', compact('booking', 'menuPaket1', 'menuPaket2'));
    }

    /**
     * Simpan Pilihan Catering (Step 2 Proses)
     */
    public function storeCatering(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'paket_id' => 'required|in:1,2',
            'durasi'   => 'required|integer|min:1|max:12'
        ]);

        if ($request->paket_id == '1') {
            $nama_paket = 'Hemat';
            $harga_per_bulan = 900000;
        } else {
            $nama_paket = 'Premium';
            $harga_per_bulan = 1000000;
        }

        $total_tambahan = $harga_per_bulan * $request->durasi;

        // Gunakan nilai dasar biaya kamar untuk perhitungan agar tidak double saat diedit
        $biaya_kamar_dasar = $booking->kamar->harga_kamar * $booking->durasi_sewa;

        $booking->update([
            'paket_catering'  => $nama_paket,
            'durasi_catering' => $request->durasi,
            'total_biaya'     => $biaya_kamar_dasar + $total_tambahan,
        ]);

        return redirect()->route('penyewa.booking.pembayaran', $booking->id);
    }

    /**
     * Halaman Pembayaran (Step 3)
     */
    public function showPembayaran($id)
    {
        // 1. Ambil data booking yang sedang diakses
        $booking = Booking::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->with('kamar')
                    ->firstOrFail();

        // 2. AMBIL SEMUA DATA KAMAR
        $semua_kamar = Kamar::orderBy('no_kamar', 'asc')->get();

        // 3. Hitung rincian biaya
        $biayaKamar = $booking->kamar->harga_kamar * $booking->durasi_sewa;
        $biayaCatering = $booking->total_biaya - $biayaKamar;

        // 4. Kirim variabel $semua_kamar ke view
        return view('penyewa.booking.pembayaran', compact('booking', 'biayaCatering', 'biayaKamar', 'semua_kamar'));
    }

    /**
     * Simpan Bukti Pembayaran (Step 3 Proses)
     */
    public function storePembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $booking->bukti_transfer = $path;
            $booking->status_pembayaran = 'Pending';
            $booking->save(); 

            return redirect()->route('penyewa.riwayat')->with('success', 'Bukti pembayaran berhasil dikirim!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar bukti transfer.');
    }

    /**
     * Riwayat Pesanan
     */
    public function riwayat()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('kamar')->latest()->get();
        return view('penyewa.riwayat', compact('bookings'));
    }

    /**
     * Fitur Ubah/Edit Booking (Step tambahan jika ada kesalahan)
     */
    public function editBooking($id)
    {
        $booking = Booking::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->where('status_pembayaran', 'Pending')
                        ->firstOrFail();

        $kamar = Kamar::findOrFail($booking->kamar_id);

        // Kita gunakan kembali view booking_form tapi dengan data yang sudah ada
        return view('penyewa.booking_form', compact('booking', 'kamar'));
    }

    /**
     * Update Data Booking
     */
    public function updateBooking(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'  => 'required',
            'no_telp'       => 'required',
            'alamat_asal'   => 'required',
            'durasi_sewa'   => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        $booking = Booking::findOrFail($id);
        $kamar = Kamar::findOrFail($booking->kamar_id);

        // Hitung ulang biaya dasar kamar
        $total_biaya_baru = $kamar->harga_kamar * $request->durasi_sewa;

        $booking->update([
            'nama_lengkap'    => $request->nama_lengkap,
            'no_telp'         => $request->no_telp,
            'alamat_asal'     => $request->alamat_asal,
            'durasi_sewa'     => $request->durasi_sewa,
            'tanggal_masuk'   => $request->tanggal_masuk,
            'total_biaya'     => $total_biaya_baru, 
            'paket_catering'  => 'Tanpa Catering', // Reset catering agar user pilih ulang sesuai durasi baru
            'durasi_catering' => 0
        ]);

        return redirect()->route('penyewa.booking.catering', $booking->id)
                        ->with('info', 'Data berhasil diperbarui. Silakan tentukan kembali layanan catering Anda.');
    }
}