<x-app-layout>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        /* Efek saat kartu dipilih */
        .card-selected { 
            border-color: #6366f1 !important; 
            background-color: #f8fafc !important;
            ring: 2px;
            ring-color: #6366f1;
        }
    </style>

    <div class="py-6 px-4 max-w-6xl mx-auto">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tighter italic">Pilih Paket Catering</h2>
            <p class="text-slate-500 text-xs font-bold italic">Menu variatif setiap hari untuk penghuni kos ginting</p>
        </div>

        <form action="{{ route('penyewa.booking.catering.store', $booking->id) }}" method="POST" id="formCatering">
            @csrf
            <div class="grid lg:grid-cols-2 gap-5 mb-8">
                
                <!-- PAKET 1: EKONOMIS (900K) -->
                <div onclick="selectPaket('paket1')" id="card-paket1" class="card-paket bg-white rounded-[2rem] p-5 border-2 border-slate-100 shadow-md relative transition-all cursor-pointer hover:border-indigo-300">
                    <input type="radio" name="paket_id" value="1" id="paket1" class="absolute top-5 right-5 h-5 w-5 text-emerald-600 focus:ring-emerald-500" required>
                    <div class="block">
                        <span class="bg-emerald-100 text-emerald-600 text-[9px] font-black px-2 py-0.5 rounded-full uppercase">Hemat</span>
                        <h3 class="text-xl font-black text-slate-800 mt-1 italic">Rp 900k<span class="text-[10px] text-slate-400 font-normal"> /bln</span></h3>
                        
                        <div class="mt-4 space-y-2 max-h-[220px] overflow-y-auto pr-1 custom-scrollbar">
                            @foreach($menuPaket1 as $hari => $menu)
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <h4 class="text-emerald-600 font-black text-[9px] uppercase mb-1">{{ $hari }}</h4>
                                <div class="text-[10px] text-slate-600 font-bold leading-tight">
                                    @foreach($menu as $m)
                                    <p class="flex items-center gap-1 mb-0.5 last:mb-0 italic"><i class="fa-solid fa-check text-[7px]"></i> {{ $m }}</p>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- PAKET 2: PREMIUM (1 JUTA) -->
                <div onclick="selectPaket('paket2')" id="card-paket2" class="card-paket bg-white rounded-[2rem] p-5 border-2 border-slate-100 shadow-md relative transition-all cursor-pointer hover:border-indigo-300">
                    <input type="radio" name="paket_id" value="2" id="paket2" class="absolute top-5 right-5 h-5 w-5 text-indigo-600 focus:ring-indigo-500">
                    <div class="block">
                        <span class="bg-indigo-100 text-indigo-600 text-[9px] font-black px-2 py-0.5 rounded-full uppercase">Premium</span>
                        <h3 class="text-xl font-black text-slate-800 mt-1 italic">Rp 1.000k<span class="text-[10px] text-slate-400 font-normal"> /bln</span></h3>
                        
                        <div class="mt-4 space-y-2 max-h-[220px] overflow-y-auto pr-1 custom-scrollbar">
                            @foreach($menuPaket2 as $hari => $menu)
                            <div class="bg-indigo-50/50 p-2.5 rounded-xl border border-indigo-100">
                                <h4 class="text-indigo-600 font-black text-[9px] uppercase mb-1">{{ $hari }}</h4>
                                <div class="text-[10px] text-slate-700 font-black leading-tight">
                                    @foreach($menu as $m)
                                    <p class="flex items-center gap-1 mb-0.5 last:mb-0 italic"><i class="fa-solid fa-star text-[7px] text-amber-500"></i> {{ $m }}</p>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER: INFO DURASI & TOMBOL -->
            <div class="bg-slate-900 rounded-[2rem] p-6 text-white shadow-xl shadow-indigo-100/20">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-center sm:text-left">
                        <h4 class="text-lg font-black uppercase italic leading-none tracking-tighter">Durasi Sewa</h4>
                        <p class="text-slate-400 text-[10px] mt-1 italic uppercase font-bold">Sesuaikan dengan masa huni kamu</p>
                    </div>
                    <div class="w-full sm:w-48">
                        <select name="durasi" class="w-full bg-slate-800 border-none rounded-xl py-3 px-4 text-xs font-black focus:ring-2 focus:ring-indigo-500 cursor-pointer text-white">
                                    @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ (isset($booking) && $booking->durasi_sewa == $i) ? 'selected' : '' }}>{{ $i }} Bulan
                                    </option>
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row gap-3 border-t border-slate-800 pt-5">
                    <button type="submit" class="flex-[2] bg-indigo-600 hover:bg-indigo-700 py-4 rounded-xl font-black uppercase tracking-widest text-[11px] transition-all shadow-lg shadow-indigo-900/50">
                        Simpan & Lanjut Pembayaran
                    </button>
                    <a href="{{ route('penyewa.booking.pembayaran', $booking->id) }}" class="flex-1 bg-slate-800 hover:bg-slate-700 py-4 rounded-xl font-black uppercase tracking-widest text-center text-[10px] text-slate-400 flex items-center justify-center transition-all">
                        Lewati Catering
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- SCRIPT AGAR KARTU BISA DIKLIK --}}
    <script>
        function selectPaket(id) {
            // Centang radio button
            document.getElementById(id).checked = true;

            // Reset semua border kartu
            document.querySelectorAll('.card-paket').forEach(card => {
                card.classList.remove('card-selected');
            });

            // Tambah border biru pada kartu yang dipilih
            document.getElementById('card-' + id).classList.add('card-selected');
        }
    </script>
</x-app-layout>