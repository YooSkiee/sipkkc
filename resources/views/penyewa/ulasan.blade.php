<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-app-layout>
    <div class="max-w-[1200px] mx-auto min-h-screen bg-slate-50 pt-10 px-6 lg:px-10 pb-20">
        
        <div class="flex items-center gap-3 mb-10">
            <div class="w-1.5 h-8 bg-indigo-600 rounded-full"></div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tighter uppercase">Beri Ulasan Kamar</h2>
        </div>

        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-2xl shadow-sm flex items-center gap-4 animate-bounce-short">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white shrink-0">
                    <i class="fa-solid fa-check"></i>
                </div>
                <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-sm border border-slate-100 max-w-4xl relative overflow-hidden">
            
            <div class="absolute -top-10 -right-10 text-slate-50 opacity-50 rotate-12 pointer-events-none">
                <i class="fa-solid fa-quote-right text-[15rem]"></i>
            </div>

            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest italic mb-8 border-l-2 border-indigo-400 pl-3 py-1 relative z-10">
                Bagikan pengalaman Anda selama menyewa unit kamar kami.<br>Ulasan Anda sangat berarti untuk peningkatan layanan kos.
            </p>

            @if(isset($riwayat_kamar) && $riwayat_kamar->count() > 0)
                <form action="{{ route('penyewa.ulasan.store') }}" method="POST" class="flex flex-col gap-8 relative z-10">
                    @csrf
                    
                    <div class="flex flex-col gap-3">
                        <label class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">1. Pilih Unit Kamar</label>
                        <div class="relative">
                            <select name="kamar_id" required class="w-full bg-slate-50 border-2 border-slate-100 text-slate-700 text-sm rounded-2xl focus:ring-0 focus:border-indigo-400 block p-4 appearance-none font-medium cursor-pointer transition-colors hover:bg-slate-100">
                                <option value="" disabled selected>-- Pilih unit kamar yang pernah/sedang Anda huni --</option>
                                @foreach($riwayat_kamar as $riwayat)
                                    <option value="{{ $riwayat->kamar->id }}">
                                        Kamar #{{ $riwayat->kamar->no_kamar }} ({{ $riwayat->kamar->tipe_kamar }} Class)
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('kamar_id')
                            <span class="text-xs font-bold text-red-500 italic mt-1">* {{ $message }}</span>
                        @enderror
                    </div>

                    <hr class="border-slate-100">

                    <div x-data="{ rating: {{ old('rating', 0) }}, hoverRating: 0 }" class="flex flex-col gap-3">
                        <label class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">2. Beri Penilaian</label>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 bg-slate-50 w-full sm:w-fit px-6 py-4 rounded-2xl border-2 border-slate-100 transition-colors" :class="rating > 0 ? 'border-amber-200 bg-amber-50/30' : ''">
                            <input type="hidden" name="rating" x-model="rating" required>
                            
                            <div class="flex items-center gap-2">
                                <template x-for="i in 5">
                                    <button type="button" 
                                        @click="rating = i" 
                                        @mouseenter="hoverRating = i" 
                                        @mouseleave="hoverRating = 0"
                                        class="focus:outline-none transition-transform duration-200 hover:scale-125">
                                        <i class="fa-solid fa-star text-3xl transition-colors duration-200" 
                                           :class="(hoverRating >= i || rating >= i) ? 'text-amber-400 drop-shadow-md' : 'text-slate-200'"></i>
                                    </button>
                                </template>
                            </div>
                            <div class="sm:ml-2 sm:pl-4 sm:border-l-2 sm:border-slate-200">
                                <span class="text-xs font-black uppercase tracking-widest" 
                                      :class="rating > 0 ? 'text-amber-500' : 'text-slate-400'" 
                                      x-text="rating > 0 ? rating + ' Bintang' : 'Belum Dipilih'"></span>
                            </div>
                        </div>
                        @error('rating')
                            <span class="text-xs font-bold text-red-500 italic mt-1">* Silakan berikan penilaian bintang terlebih dahulu.</span>
                        @enderror
                    </div>

                    <hr class="border-slate-100">

                    <div class="flex flex-col gap-3">
                        <label class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">3. Tulis Pengalaman Anda</label>
                        <textarea name="komentar" rows="5" required 
                                  placeholder="Ceritakan pengalaman Anda di sini... (Contoh: Kamarnya bersih, air lancar, ibu kos ramah, dll)" 
                                  class="w-full bg-slate-50 border-2 border-slate-100 text-slate-700 text-sm rounded-2xl focus:ring-0 focus:border-indigo-400 block p-5 resize-none transition-colors hover:bg-slate-100">{{ old('komentar') }}</textarea>
                        @error('komentar')
                            <span class="text-xs font-bold text-red-500 italic mt-1">* {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-200 active:scale-95 flex items-center gap-3">
                            Kirim Ulasan Sekarang <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            
            @else
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-10 flex flex-col items-center justify-center text-center relative z-10 mt-5">
                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mb-4">
                        <i class="fa-solid fa-bed text-2xl text-slate-400"></i>
                    </div>
                    <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest mb-2">Belum Ada Riwayat</h3>
                    <p class="text-xs font-medium text-slate-500 max-w-sm">
                        Anda belum memiliki riwayat pemesanan kamar untuk diulas. Silakan lakukan pemesanan terlebih dahulu.
                    </p>
                    <a href="{{ route('penyewa.menu') }}" class="mt-6 bg-white text-indigo-600 border border-indigo-100 px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-50 transition-colors shadow-sm">
                        Lihat Katalog Kamar
                    </a>
                </div>
            @endif

        </div>
    </div>

    <style>
        @keyframes bounce-short {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-5px); }
            60% { transform: translateY(-3px); }
        }
        .animate-bounce-short {
            animation: bounce-short 1s ease-in-out 1;
        }
    </style>
</x-app-layout>