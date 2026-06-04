<x-guest-layout>
    <div class="min-h-[500px] flex flex-col justify-center">
        <!-- Header Dinamis: Merah untuk Admin, Hijau untuk Manager, Biru untuk Penyewa -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 
                {{ request()->query('role') == 'admin' ? 'bg-red-600 shadow-red-100' : (request()->query('role') == 'manager' ? 'bg-emerald-600 shadow-emerald-100' : 'bg-indigo-600 shadow-indigo-100') }} 
                rounded-2xl mb-4 shadow-xl">
                <i class="fa-solid {{ request()->query('role') == 'admin' ? 'fa-user-shield' : (request()->query('role') == 'manager' ? 'fa-user-tie' : 'fa-house-chimney') }} text-white text-2xl"></i>
            </div>
            
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">
                @if(request()->query('role') == 'admin')
                    Portal Admin
                @elseif(request()->query('role') == 'manager')
                    Portal Manager
                @else
                    Portal Penyewa
                @endif
            </h2>
            <p class="text-slate-400 text-sm font-medium mt-2">Selamat datang kembali di Kos Ginting</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 focus:ring-4 
                    {{ request()->query('role') == 'admin' ? 'focus:ring-red-100 focus:border-red-500' : (request()->query('role') == 'manager' ? 'focus:ring-emerald-100 focus:border-emerald-500' : 'focus:ring-indigo-100 focus:border-indigo-400') }} 
                    outline-none transition-all shadow-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-2 ml-1">
                    <label for="password" class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a class="text-[10px] font-bold {{ request()->query('role') == 'admin' ? 'text-red-600' : (request()->query('role') == 'manager' ? 'text-emerald-600' : 'text-indigo-600') }} uppercase tracking-widest transition-colors" href="{{ route('password.request') }}">
                            Lupa Sandi?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required 
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 focus:ring-4 
                    {{ request()->query('role') == 'admin' ? 'focus:ring-red-100 focus:border-red-500' : (request()->query('role') == 'manager' ? 'focus:ring-emerald-100 focus:border-emerald-500' : 'focus:ring-indigo-100 focus:border-indigo-400') }} 
                    outline-none transition-all shadow-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center ml-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded-md border-slate-300 {{ request()->query('role') == 'admin' ? 'text-red-600 focus:ring-red-500' : (request()->query('role') == 'manager' ? 'text-emerald-600 focus:ring-emerald-500' : 'text-indigo-600 focus:ring-indigo-500') }} shadow-sm w-4 h-4" name="remember">
                    <span class="ms-3 text-xs font-bold text-slate-500 uppercase tracking-tighter">Ingat akun saya</span>
                </label>
            </div>

            <!-- Tombol Login Dinamis -->
            <div class="pt-4">
                <button type="submit" class="w-full 
                    {{ request()->query('role') == 'admin' ? 'bg-red-600 hover:bg-red-700 shadow-red-100' : (request()->query('role') == 'manager' ? 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-100' : 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-100') }} 
                    text-white font-black py-4 rounded-2xl text-xs tracking-[0.2em] transition-all shadow-xl active:scale-[0.98] uppercase">
                    Masuk Sekarang
                </button>
            </div>

            <!-- Link Registrasi -->
            @if(!request()->query('role') || request()->query('role') == 'penyewa')
            <div class="mt-10 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">
                    Belum bergabung? 
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 ml-1 transition-colors font-black">Daftar Akun Baru</a>
                </p>
            </div>
            @endif
        </form>
    </div>
</x-guest-layout>