<x-guest-layout>
    <div class="flex flex-col justify-center">
        <!-- Header Registrasi -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-4 shadow-xl shadow-indigo-100">
                <i class="fa-solid fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Daftar Akun</h2>
            <p class="text-slate-400 text-sm font-medium mt-2">Bergabunglah dengan komunitas Kos Ginting</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 outline-none transition-all shadow-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 outline-none transition-all shadow-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Kata Sandi</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 outline-none transition-all shadow-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 outline-none transition-all shadow-sm">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Tombol Register -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl text-xs tracking-[0.2em] transition-all shadow-xl shadow-indigo-100 active:scale-[0.98] uppercase">
                    Daftar Sekarang
                </button>
            </div>

            <!-- Link Balik Ke Login -->
            <div class="mt-8 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 ml-1 transition-colors">Masuk di sini</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>