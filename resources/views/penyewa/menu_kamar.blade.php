<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-app-layout>
    <div x-data="{ 
        lantai: 'Standard', 
        selectedKamar: null 
    }" class="max-w-[1600px] mx-auto min-h-screen flex flex-col lg:flex-row bg-slate-50 pb-10">
        
        <div class="w-full lg:w-7/12 p-6 lg:p-10 flex flex-col border-r border-slate-200">
            
            <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-end text-left gap-4">
                <div class="text-left">
                    <h4 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.4em] mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </h4>
                    <h2 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none mb-3">
                        Denah <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-sky-400">Lokasi kamar</span>
                    </h2>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest italic border-l-2 border-indigo-400 pl-3 py-1">
                        Silakan pilih unit kamar yang tersedia pada denah di bawah<br>sesuai dengan keinginan dan kebutuhan Anda.
                    </p>
                </div>
                <div class="bg-slate-900 text-white px-5 py-3 rounded-2xl font-black text-[10px] uppercase italic tracking-widest shadow-xl shrink-0 flex flex-col items-end">
                    <span>Lantai <span x-text="lantai == 'Standard' ? '1' : (lantai == 'Deluxe' ? '2' : '3')" class="text-indigo-400 text-sm ml-1"></span></span>
                    <span class="text-[8px] text-slate-400 mt-1" x-text="lantai + ' CLASS'"></span>
                </div>
            </div>

            <div class="flex-1 bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 lg:p-12 flex flex-col justify-center items-center relative w-full">
                <div class="w-full max-w-[600px] mx-auto flex flex-col items-center">
                    
                    <div class="bg-slate-50/80 p-2 rounded-full border border-slate-100 flex justify-center gap-2 mb-10 relative z-50 shadow-inner overflow-x-auto w-full md:w-auto">
                        <button @click="lantai = 'Standard'; selectedKamar = null" :class="lantai === 'Standard' ? 'bg-white shadow-md ring-2 ring-emerald-100 border-emerald-400 opacity-100 scale-105' : 'opacity-50 grayscale border-transparent hover:opacity-80'" class="flex items-center gap-3 transition-all duration-300 border-2 py-2.5 px-5 rounded-full shrink-0">
                            <span class="w-4 h-4 bg-emerald-400 rounded-full shadow-inner"></span>
                            <div class="text-left flex flex-col">
                                <span class="text-[9px] font-black text-slate-800 uppercase italic leading-none">Lantai 1</span>
                                <span class="text-[7px] font-bold text-emerald-500 uppercase tracking-widest mt-1">Standard</span>
                            </div>
                        </button>
                        <button @click="lantai = 'Deluxe'; selectedKamar = null" :class="lantai === 'Deluxe' ? 'bg-white shadow-md ring-2 ring-sky-100 border-sky-400 opacity-100 scale-105' : 'opacity-50 grayscale border-transparent hover:opacity-80'" class="flex items-center gap-3 transition-all duration-300 border-2 py-2.5 px-5 rounded-full shrink-0">
                            <span class="w-4 h-4 bg-sky-400 rounded-full shadow-inner"></span>
                            <div class="text-left flex flex-col">
                                <span class="text-[9px] font-black text-slate-800 uppercase italic leading-none">Lantai 2</span>
                                <span class="text-[7px] font-bold text-sky-500 uppercase tracking-widest mt-1">Deluxe</span>
                            </div>
                        </button>
                        <button @click="lantai = 'VIP'; selectedKamar = null" :class="lantai === 'VIP' ? 'bg-white shadow-md ring-2 ring-amber-100 border-amber-400 opacity-100 scale-105' : 'opacity-50 grayscale border-transparent hover:opacity-80'" class="flex items-center gap-3 transition-all duration-300 border-2 py-2.5 px-5 rounded-full shrink-0">
                            <span class="w-4 h-4 bg-amber-400 rounded-full shadow-inner"></span>
                            <div class="text-left flex flex-col">
                                <span class="text-[9px] font-black text-slate-800 uppercase italic leading-none">Lantai 3</span>
                                <span class="text-[7px] font-bold text-amber-500 uppercase tracking-widest mt-1">VIP</span>
                            </div>
                        </button>
                    </div>

                    @php
                        // Mapping posisi melingkar bentuk "U" dari dekat pintu masuk
                        $gridPositions = [
                            'col-start-1 row-start-4', // Index 0 (V01)
                            'col-start-1 row-start-3', // Index 1 (V02)
                            'col-start-1 row-start-2', // Index 2 (V03)
                            'col-start-1 row-start-1', // Index 3 (V04)
                            'col-start-2 row-start-1', // Index 4 (V05)
                            'col-start-3 row-start-1', // Index 5 (V06)
                            'col-start-4 row-start-1', // Index 6 (V07)
                            'col-start-5 row-start-1', // Index 7 (V08)
                            'col-start-5 row-start-2', // Index 8 (V09)
                            'col-start-5 row-start-3', // Index 9 (V10)
                        ];
                    @endphp

                    <div class="grid grid-cols-5 grid-rows-4 gap-3 md:gap-4 relative z-10 w-full h-auto">
                        @foreach(['Standard', 'Deluxe', 'VIP'] as $type)
                            @php 
                                // Diurutkan berdasarkan no_kamar supaya masuk ke array mapping dengan benar
                                $typeRooms = $kamar->where('tipe_kamar', $type)->sortBy('no_kamar')->values(); 
                            @endphp
                            <template x-if="lantai === '{{ $type }}'">
                                <div class="contents">
                                    
                                    @foreach($typeRooms as $index => $room)
                                        @if(isset($gridPositions[$index]))
                                            @php 
                                                // Logika Status 3 Lapis
                                                $isTerisi = ($room->status_kamar == 'Terisi');
                                                $isPerbaikan = ($room->status_kamar == 'Perbaikan');
                                                $isUnavailable = ($isTerisi || $isPerbaikan);

                                                // --- PACKING DATA ULASAN ---
                                                $ulasanTerbaru = $room->ulasans->first();
                                                $roomData = [
                                                    'id' => $room->id,
                                                    'no' => $room->no_kamar,
                                                    'tipe' => $room->tipe_kamar,
                                                    'harga' => $room->harga_kamar,
                                                    'avg_rating' => round($room->ulasans_avg_rating ?? 0, 1),
                                                    'total_reviews' => $room->ulasans_count ?? 0,
                                                    'review' => $ulasanTerbaru ? [
                                                        'nama' => $ulasanTerbaru->user->name ?? 'Penyewa',
                                                        'inisial' => substr($ulasanTerbaru->user->name ?? 'P', 0, 1),
                                                        'waktu' => $ulasanTerbaru->created_at->diffForHumans(),
                                                        'komentar' => $ulasanTerbaru->komentar
                                                    ] : null
                                                ];
                                                $roomJson = htmlspecialchars(json_encode($roomData), ENT_QUOTES, 'UTF-8');
                                            @endphp

                                            
                                            <div @click="{!! $isUnavailable ? '' : 'selectedKamar = '.$roomJson !!}" 
                                                class="{{ $gridPositions[$index] }} relative border-[1.5px] rounded-[1.5rem] h-20 md:h-24 flex flex-col items-center justify-center transition-all duration-300 hover:scale-[1.03] 
                                                        {{ $isTerisi ? 'bg-slate-50 border-slate-200 opacity-50 grayscale cursor-not-allowed' : '' }}
                                                        {{ $isPerbaikan ? 'bg-orange-50 border-orange-200 opacity-80 cursor-not-allowed' : '' }}
                                                        {{ !$isUnavailable ? 'bg-white border-slate-200 cursor-pointer shadow-sm hover:border-indigo-300 hover:shadow-md' : '' }}"
                                                 :class="selectedKamar && selectedKamar.id == {{ $room->id }} ? 'ring-4 ring-indigo-100 border-indigo-500 scale-[1.05] z-20 shadow-indigo-100' : ''">
                                                
                                                <span class="text-[11px] font-black tracking-tighter {{ $isPerbaikan ? 'text-orange-700' : 'text-slate-700' }}">{{ $room->no_kamar }}</span>
                                                
                                                <i class="fa-solid 
                                                    {{ $isTerisi ? 'fa-lock text-slate-400' : '' }} 
                                                    {{ $isPerbaikan ? 'fa-wrench text-orange-400' : '' }} 
                                                    {{ !$isUnavailable ? 'fa-circle-check text-emerald-400' : '' }} 
                                                    text-[9px] mt-1"></i>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="col-start-2 col-span-3 row-start-2 row-span-2 bg-slate-50/80 rounded-[2.5rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center shadow-inner">
                                        <i class="fa-solid fa-square-p text-4xl text-slate-300"></i>
                                        <p class="text-[8px] font-black uppercase tracking-[0.3em] text-slate-400 mt-2 italic">Area Parkir Dalam</p>
                                    </div>

                                    <div class="col-start-2 col-span-3 row-start-4 flex flex-col items-center justify-start pt-3 border-t-[3px] border-dashed border-slate-200/70 mt-1">
                                        <i class="fa-solid fa-arrow-up text-slate-300 animate-bounce text-sm"></i>
                                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest italic mt-1.5">Pintu Masuk Utama</span>
                                    </div>

                                </div>
                            </template>
                        @endforeach
                    </div>
                    
                    <div class="mt-10 pt-6 border-t border-slate-100 w-full flex flex-col items-center gap-4">
                        
                        <div class="flex justify-center gap-6 w-full flex-wrap">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-full bg-white border-[1.5px] border-slate-200 flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-circle-check text-[10px] text-emerald-400"></i>
                                </div>
                                <span class="text-[9px] font-black uppercase text-slate-500 tracking-widest italic">Tersedia</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-full bg-slate-50 border-[1.5px] border-slate-200 flex items-center justify-center shadow-sm opacity-60">
                                    <i class="fa-solid fa-lock text-[9px] text-slate-400"></i>
                                </div>
                                <span class="text-[9px] font-black uppercase text-slate-500 tracking-widest italic">Terisi</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-full bg-orange-50 border-[1.5px] border-orange-200 flex items-center justify-center shadow-sm opacity-80">
                                    <i class="fa-solid fa-wrench text-[9px] text-orange-400"></i>
                                </div>
                                <span class="text-[9px] font-black uppercase text-slate-500 tracking-widest italic">Perbaikan</span>
                            </div>
                        </div>

                        <div class="flex justify-center gap-6 w-full mt-2">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-400 shadow-inner"></span>
                                <span class="text-[8px] font-black uppercase text-slate-400 tracking-widest italic">Standard</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-sky-400 shadow-inner"></span>
                                <span class="text-[8px] font-black uppercase text-slate-400 tracking-widest italic">Deluxe</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-amber-400 shadow-inner"></span>
                                <span class="text-[8px] font-black uppercase text-slate-400 tracking-widest italic">VIP</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-5/12 p-6 lg:p-12 lg:sticky lg:top-0 lg:h-screen flex flex-col justify-center bg-white/40 backdrop-blur-md text-left overflow-y-auto">
            
            <div x-show="selectedKamar !== null" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" class="text-left w-full max-w-md mx-auto">
                <h4 class="text-[9px] font-black text-indigo-600 uppercase tracking-[0.2em] italic mb-3 text-left">Rincian Unit Terpilih:</h4>
                <div class="bg-slate-900 rounded-[2.5rem] p-7 shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-5 opacity-5 group-hover:rotate-6 transition-transform duration-700">
                        <i class="fa-solid fa-bed text-9xl text-white"></i>
                    </div>
                    
                    <div class="flex items-center gap-5 relative z-10 text-left">
                        <div class="w-20 h-20 bg-white/10 rounded-2xl overflow-hidden border border-white/20 shadow-inner shrink-0">
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover">
                        </div>
                        <div class="text-left">
                            <h3 class="text-xl font-black text-white italic tracking-tighter uppercase leading-tight" x-text="selectedKamar ? selectedKamar.tipe + ' CLASS' : ''"></h3>
                            <p class="text-indigo-300 text-[10px] font-black uppercase tracking-widest mt-0.5" x-text="selectedKamar ? 'Room #' + selectedKamar.no : ''"></p>
                            
                            <div class="flex items-center gap-1 mt-2">
                                <template x-for="i in 5">
                                    <i class="fa-solid text-[10px]" 
                                       :class="i <= Math.round(selectedKamar.avg_rating) ? 'fa-star text-amber-400' : 'fa-star text-white/20'"></i>
                                </template>
                                <span class="text-white/70 text-[9px] ml-1 font-bold">
                                    <span x-text="selectedKamar.avg_rating > 0 ? selectedKamar.avg_rating : 'Belum dinilai'"></span>
                                    <span class="font-normal" x-show="selectedKamar.total_reviews > 0" x-text="'(' + selectedKamar.total_reviews + ' Ulasan)'"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 bg-white/5 rounded-2xl p-4 border border-white/10 text-white/90 relative z-10">
                        <p class="text-[9px] font-black text-indigo-300 uppercase tracking-widest mb-2 italic">Fasilitas Kamar:</p>
                        
                        <template x-if="selectedKamar && selectedKamar.tipe === 'VIP'">
                            <p class="text-[10px] font-bold leading-relaxed tracking-tight italic text-left">
                                AC, Kamar mandi dalam, Tempat tidur, meja belajar, wifi
                            </p>
                        </template>

                        <template x-if="selectedKamar && selectedKamar.tipe === 'Deluxe'">
                            <p class="text-[10px] font-bold leading-relaxed tracking-tight italic text-left">
                                Kipas Angin, Kamar mandi dalam, Tempat tidur, Meja Belajar
                            </p>
                        </template>

                        <template x-if="selectedKamar && (selectedKamar.tipe === 'Standard' || selectedKamar.tipe === 'Standar')">
                            <p class="text-[10px] font-bold leading-relaxed tracking-tight italic text-left">
                                Kipas Angin, Kamar mandi dalam, Tempat tidur
                            </p>
                        </template>
                    </div>

                    <div x-show="selectedKamar && selectedKamar.review !== null" class="mt-4 bg-white/5 rounded-2xl p-4 border border-white/10 relative z-10">
                        <div class="flex justify-between items-center mb-3">
                            <p class="text-[9px] font-black text-indigo-300 uppercase tracking-widest italic">Ulasan Terbaru:</p>
                        </div>
                        
                        <div class="bg-black/20 rounded-xl p-3 border border-white/5">
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-5 h-5 bg-indigo-500 rounded-full flex items-center justify-center text-[9px] text-white font-bold shadow-inner uppercase" x-text="selectedKamar ? selectedKamar.review.inisial : ''">
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-white font-bold leading-none" x-text="selectedKamar ? selectedKamar.review.nama : ''"></span>
                                    <span class="text-[7px] text-white/40 mt-0.5" x-text="selectedKamar ? selectedKamar.review.waktu : ''"></span>
                                </div>
                            </div>
                            <p class="text-[9px] italic text-white/70 leading-relaxed" x-text="selectedKamar ? '&quot;' + selectedKamar.review.komentar + '&quot;' : ''"></p>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-between text-left border-t border-white/10 pt-5 relative z-10">
                        <div class="text-left">
                            <p class="text-[7px] font-black text-indigo-300 uppercase italic mb-0.5 tracking-widest text-left">Rate / Bulan</p>
                            <p class="text-lg font-black text-white font-mono text-left" x-text="selectedKamar ? 'Rp ' + new Intl.NumberFormat('id-ID').format(selectedKamar.harga) : ''"></p>
                        </div>
                        <a :href="'/penyewa/booking/' + (selectedKamar ? selectedKamar.id : '')" class="bg-white text-slate-900 px-6 py-3 rounded-xl font-black text-[9px] uppercase italic tracking-widest hover:bg-indigo-400 hover:text-white transition-all shadow-lg active:scale-95 text-center">
                            Lanjutkan Pesan
                        </a>
                    </div>
                </div>
            </div>

            <div x-show="selectedKamar === null" class="flex-1 flex flex-col items-center justify-center opacity-40">
                <div class="w-24 h-24 bg-slate-200/50 rounded-full flex items-center justify-center mb-5 animate-pulse">
                    <i class="fa-solid fa-hand-pointer text-4xl text-slate-400"></i>
                </div>
                <p class="text-[10px] font-black uppercase italic tracking-widest text-slate-500 text-center max-w-[200px] leading-relaxed">
                    Pilih kotak kamar pada denah di samping untuk melihat rincian
                </p>
            </div>
        </div>
    </div>
</x-app-layout>