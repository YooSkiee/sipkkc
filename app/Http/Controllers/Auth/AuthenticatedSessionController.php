<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // --- LOGIKA REDIRECT BERDASARKAN ROLE (SUDAH DITAMBAH MANAGER) ---
        if ($request->user()->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } 
        
        if ($request->user()->role === 'manager') {
            // Tambahkan ini agar manager masuk ke dashboardnya sendiri
            return redirect()->intended(route('manager.dashboard'));
        }

        if ($request->user()->role === 'penyewa') {
            // Sesuai permintaanmu, penyewa masuk ke halaman Welcome dulu
            return redirect()->intended(route('penyewa.welcome'));
        }

        // Default jika role tidak dikenali
        return redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}