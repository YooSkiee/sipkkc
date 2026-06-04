<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">Finalisasi Pembayaran</h2>
            <div class="flex justify-center items-center gap-2 mt-2">
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">1. Booking</span>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">2. Layanan</span>
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-[9px] font-black text-indigo-600 uppercase tracking-widest italic">3. Pembayaran</span>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] p-10 shadow-2xl shadow-slate-100 border border-slate-50">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                
                <div>
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 italic">Instruksi Pembayaran</h4>
                    
                    <div class="space-y-6">
                        <div class="bg-slate-50 border border-slate-100 p-6 rounded-[2rem]">
                            <p class="text-[9px] font-black text-slate-400 uppercase italic">Transfer Ke Bank BRI</p>
                            <h3 class="text-xl font-black text-slate-800 tracking-widest mt-1">0123 4567 8910</h3>
                            <p class="text-[10px] font-bold text-indigo-600 uppercase mt-1 italic">a.n KOS GINTING (SIPKKC)</p>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between mb-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase italic">Kamar (#{{ $booking->kamar->no_kamar }})</span>
                                <span class="text-[10px] font-black text-slate-800 font-mono">Rp {{ number_format($booking->kamar->harga_kamar * $booking->durasi_sewa, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between mb-4 pb-4 border-b border-dashed border-slate-200">
                                <span class="text-[10px] font-bold text-slate-400 uppercase italic">Layanan Catering</span>
                                <span class="text-[10px] font-black text-slate-800 font-mono">
                                    {{ $booking->paket_catering == 'Tanpa Catering' ? 'Rp 0' : 'Rp ' . number_format($booking->total_biaya - ($booking->kamar->harga_kamar * $booking->durasi_sewa), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-black text-slate-800 uppercase italic">Total Tagihan</span>
                                <span class="text-xl font-black text-indigo-600 font-mono">Rp {{ number_format($booking->total_biaya, 0, ',', '.') }}</span>
                            </div>

                            <div class="mt-8 pt-6 border-t border-slate-100 text-center sm:text-left">
                                <p class="text-[10px] font-bold text-slate-400 uppercase italic mb-2">Ada kesalahan data?</p>
                                <a href="{{ route('penyewa.booking.edit', $booking->id) }}" class="inline-flex items-center gap-2 text-rose-500 hover:text-rose-700 transition-colors">
                                    <div class="w-8 h-8 bg-rose-50 rounded-xl flex items-center justify-center">
                                        <i class="fa-solid fa-pen-to-square text-[12px]"></i>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest italic border-b-2 border-rose-100 hover:border-rose-500">Ubah Durasi / Data Sewa</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl shadow-indigo-100/20">
                    <form action="{{ route('penyewa.booking.pembayaran.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-8">
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] italic">Konfirmasi</p>
                            <h4 class="text-sm font-black italic tracking-tighter mt-1">Unggah Bukti Transfer</h4>
                        </div>

                        <div class="relative group h-48">
                            <input type="file" name="bukti_transfer" required accept="image/*" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="previewImage(this)">
                            <div id="dropzone" class="h-full bg-white/5 border-2 border-dashed border-white/10 rounded-[2rem] flex flex-col items-center justify-center group-hover:bg-white/10 group-hover:border-indigo-500/50 transition-all overflow-hidden">
                                <i class="fa-solid fa-image text-3xl text-slate-700 mb-2 group-hover:scale-110 transition-transform"></i>
                                <p class="text-[9px] font-black text-slate-500 uppercase italic tracking-widest text-center px-4">Klik atau seret gambar ke sini</p>
                                <img id="preview" class="absolute inset-0 w-full h-full object-cover hidden">
                            </div>
                        </div>

                        <p class="text-[8px] text-center text-slate-500 mt-4 italic uppercase font-bold tracking-tighter">Format: JPG, PNG (Maks. 2MB)</p>

                        <button type="submit" class="w-full mt-8 bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] italic transition-all shadow-lg shadow-indigo-900/40">
                            Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const dropzone = document.getElementById('dropzone');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>