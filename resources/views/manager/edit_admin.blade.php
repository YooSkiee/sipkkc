<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6 bg-slate-50 min-h-screen flex flex-col justify-center">
        
        <div class="mb-10 text-left border-b border-slate-200 pb-6">
            <h4 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.4em] mb-2 flex items-center gap-2">
                <i class="fa-solid fa-user-shield"></i> System Security
            </h4>
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase leading-none mb-2">
                Pengaturan Akun <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-sky-400">Admin</span>
            </h2>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest italic">
                Perbarui alamat email dan password akses untuk petugas operasional (Admin).
            </p>
        </div>

        @if (session('success'))
            <div class="mb-8 p-6 bg-emerald-50 border border-emerald-200 rounded-3xl flex items-center gap-4 shadow-sm">
                <div class="w-10 h-10 bg-emerald-400 rounded-full flex items-center justify-center text-white shrink-0 shadow-inner">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <h3 class="text-xs font-black text-emerald-700 uppercase tracking-widest">Berhasil!</h3>
                    <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any() || session('error'))
            <div class="mb-8 p-6 bg-rose-50 border border-rose-200 rounded-3xl shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <i class="fa-solid fa-triangle-exclamation text-rose-500"></i>
                    <h3 class="text-xs font-black text-rose-700 uppercase tracking-widest">Gagal Menyimpan!</h3>
                </div>
                <ul class="list-disc list-inside text-[10px] font-bold text-rose-500 uppercase tracking-wider">
                    @if(session('error')) <li>{{ session('error') }}</li> @endif
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 lg:p-12 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 p-8 opacity-5 rotate-12 pointer-events-none">
                <i class="fa-solid fa-key text-9xl text-slate-900"></i>
            </div>

            <form action="{{ route('manager.update.admin') }}" method="POST" class="relative z-10 text-left">
                @csrf
                @method('PUT')
                
                {{-- ID Admin yang mau diubah --}}
                <input type="hidden" name="admin_id" value="{{ $admin->id }}">

                <div class="grid grid-cols-1 gap-8 mb-10">
                    
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center text-slate-500 text-xl">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic mb-0.5">Nama Petugas Admin</p>
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $admin->name }}</h3>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-2">
                            Alamat Email Akses
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-slate-400 text-sm"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                                class="w-full bg-white border-2 border-slate-100 rounded-2xl py-4 pl-12 pr-4 text-sm font-bold text-slate-800 shadow-sm focus:ring-4 focus:ring-indigo-50/50 focus:border-indigo-400 transition-all">
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex-1 border-t border-slate-100"></div>
                        <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest italic">Ubah Password (Opsional)</span>
                        <div class="flex-1 border-t border-slate-100"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-2">
                                Password Baru
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-slate-400 text-sm"></i>
                                </div>
                                <input type="password" name="password" placeholder="Biarkan kosong jika tidak diubah"
                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 pl-12 pr-4 text-sm font-bold text-slate-800 shadow-sm focus:bg-white focus:ring-4 focus:ring-indigo-50/50 focus:border-indigo-400 transition-all placeholder:text-slate-300 placeholder:font-medium placeholder:text-xs">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-2">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-shield-check text-slate-400 text-sm"></i>
                                </div>
                                <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru"
                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 pl-12 pr-4 text-sm font-bold text-slate-800 shadow-sm focus:bg-white focus:ring-4 focus:ring-indigo-50/50 focus:border-indigo-400 transition-all placeholder:text-slate-300 placeholder:font-medium placeholder:text-xs">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8 pt-8 border-t border-slate-100">
                    <a href="{{ route('manager.dashboard') }}" class="px-8 py-4 bg-white text-slate-500 border-2 border-slate-200 rounded-2xl font-black text-[10px] uppercase italic tracking-widest hover:border-slate-300 hover:text-slate-700 transition-all">
                        Kembali
                    </a>
                    <button type="submit" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase italic tracking-widest hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200 active:scale-95 flex items-center gap-3">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>