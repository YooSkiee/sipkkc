<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PenyewaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UlasanController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pilih_login');
})->name('pilih.login');

/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Profile Management
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN SECTION
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/pesanan', 'indexBooking')->name('booking.index');
            Route::patch('/pesanan/{id}', 'updateStatus')->name('booking.update');
            
            // ---> ROUTE UNTUK ADMIN MELIHAT ULASAN <---
            Route::get('/ulasan', 'ulasanIndex')->name('ulasan.index');
            
            Route::prefix('kamar')->name('kamar.')->group(function () {
                Route::get('/', 'kamarIndex')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'kamarDestroy')->name('destroy');
            });

            Route::prefix('catering')->name('catering.')->group(function () {
                Route::get('/', 'cateringIndex')->name('index');
                Route::get('/create', 'cateringCreate')->name('create');
                Route::post('/', 'cateringStore')->name('store');
                Route::get('/{id}/edit', 'cateringEdit')->name('edit');
                Route::put('/{id}', 'cateringUpdate')->name('update');
                Route::delete('/{id}', 'cateringDestroy')->name('destroy');
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | MANAGER SECTION
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:manager'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('dashboard');
        
        // ---> ROUTE LAPORAN TRANSAKSI <---
        Route::get('/laporan-transaksi', [ManagerController::class, 'laporanTransaksi'])->name('laporan');
        Route::get('/cetak-laporan', [ManagerController::class, 'cetakLaporan'])->name('cetak');

        // ---> ROUTE UNTUK PENGATURAN AKUN ADMIN <---
        Route::get('/pengaturan-admin', [ManagerController::class, 'editAdmin'])->name('edit.admin');
        Route::put('/pengaturan-admin/update', [ManagerController::class, 'updateAdmin'])->name('update.admin');

        // ---> INI ROUTE BARU UNTUK MANAGER MELIHAT ULASAN <---
        Route::get('/ulasan', [ManagerController::class, 'ulasanIndex'])->name('ulasan.index');
    });

    /*
    |--------------------------------------------------------------------------
    | PENYEWA SECTION
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:penyewa'])->prefix('penyewa')->name('penyewa.')->group(function () {
        
        // Controller khusus untuk Penyewa
        Route::controller(PenyewaController::class)->group(function () {
            Route::get('/welcome', 'welcome')->name('welcome');
            Route::get('/riwayat', 'riwayat')->name('riwayat');
            Route::get('/menu', 'menuKamar')->name('menu');
            
            Route::prefix('booking')->name('booking.')->group(function () {
                Route::get('/{kamar_id}', 'showBookingForm')->name('form');
                Route::post('/store', 'storeBooking')->name('store');
                
                // --- FITUR EDIT & UPDATE ---
                Route::get('/{id}/edit', 'editBooking')->name('edit');
                Route::put('/{id}/update', 'updateBooking')->name('update');
                
                Route::get('/{id}/catering', 'showCatering')->name('catering');
                Route::post('/{id}/catering/store', 'storeCatering')->name('catering.store');
                Route::get('/{id}/pembayaran', 'showPembayaran')->name('pembayaran');
                Route::post('/{id}/pembayaran/store', 'storePembayaran')->name('pembayaran.store');
            });
        });

        // ---> ROUTE ULASAN DIPINDAH KE SINI (Di luar group booking) <---
        Route::get('/ulasan', [UlasanController::class, 'create'])->name('ulasan.create');
        Route::post('/ulasan/store', [UlasanController::class, 'store'])->name('ulasan.store');
        
    });
});

/*
|--------------------------------------------------------------------------
| 3. GLOBAL DASHBOARD REDIRECTOR
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match($user?->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'manager' => redirect()->route('manager.dashboard'),
        'penyewa' => redirect()->route('penyewa.welcome'),
        default   => redirect('/'),
    };
})->middleware(['auth'])->name('dashboard');

// Pastikan nama method di sini sama persis dengan yang di Controller
Route::get('/admin/catering/create', [AdminController::class, 'cateringCreate'])->name('admin.catering.create');

require __DIR__.'/auth.php';