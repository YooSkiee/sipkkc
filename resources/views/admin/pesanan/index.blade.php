<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Header Halaman -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-slate-800 tracking-tighter italic uppercase">Daftar Pesanan Masuk</h2>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Manajemen Konfirmasi Pembayaran SIPKKC</p>
        </div>

        <div class="bg-white rounded-[3rem] p-8 shadow-2xl shadow-slate-100 border border-slate-50">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">
                            <th class="px-6 pb-2">Penyewa</th>
                            <th class="px-6 pb-2">Kamar</th>
                            <th class="px-6 pb-2">Bukti Bayar</th>
                            <th class="px-6 pb-2">Status</th>
                            <th class="px-6 pb-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                        <tr class="bg-slate-50/50 rounded-2xl overflow-hidden shadow-sm hover:bg-slate-100/50 transition-all">
                            <td class="px-6 py-4">
                                <p class="text-sm font-black text-slate-800 italic">{{ $b->nama_lengkap }}</p>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">{{ $b->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-indigo-600 font-black italic">#{{ $b->kamar->no_kamar ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{-- Menggunakan kolom bukti_transfer sesuai struktur DB image_a3869d.jpg --}}
                                @if($b->bukti_transfer)
                                    <button onclick="openModal('{{ asset('storage/' . $b->bukti_transfer) }}', '{{ $b->nama_lengkap }}', '{{ number_format($b->total_biaya, 0, ',', '.') }}')" 
                                        class="bg-emerald-100 text-emerald-600 px-4 py-1.5 rounded-xl font-black text-[9px] uppercase tracking-widest italic hover:bg-emerald-200 transition-all flex items-center gap-2">
                                        <i class="fa-solid fa-image"></i> Lihat Bukti
                                    </button>
                                @else
                                    <span class="text-[9px] font-black text-slate-300 uppercase italic">Belum Upload</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase italic 
                                    {{ $b->status_pembayaran == 'Lunas' ? 'bg-emerald-100 text-emerald-600' : ($b->status_pembayaran == 'Ditolak' ? 'bg-rose-100 text-rose-600' : 'bg-amber-100 text-amber-600') }}">
                                    {{ $b->status_pembayaran }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($b->status_pembayaran == 'Pending')
                                <div class="flex justify-center gap-2">
                                    {{-- Form Terima Pesanan --}}
                                    <form action="{{ route('admin.booking.update', $b->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Lunas">
                                        <button type="submit" onclick="return confirm('Konfirmasi pesanan ini? Kamar akan otomatis terisi.')" 
                                            class="bg-indigo-600 text-white px-4 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest italic shadow-lg shadow-indigo-100 hover:scale-105 transition-transform">
                                            Terima
                                        </button>
                                    </form>
                                    
                                    {{-- Form Tolak Pesanan --}}
                                    <form action="{{ route('admin.booking.update', $b->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button type="submit" onclick="return confirm('Tolak pesanan ini?')" 
                                            class="bg-rose-500 text-white px-4 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest italic shadow-lg shadow-rose-100 hover:scale-105 transition-transform">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                                @else
                                    <span class="text-[9px] font-black text-slate-300 uppercase italic">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-20">
                                <p class="text-[10px] font-black text-slate-300 uppercase italic tracking-widest">Tidak ada pesanan masuk</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL PREVIEW DETAIL (BUKTI TRANSFER) -->
    <div id="modalPreview" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-[3rem] max-w-lg w-full p-8 shadow-2xl relative border border-slate-100 animate-in fade-in zoom-in duration-300">
            <button onclick="closeModal()" class="absolute top-6 right-6 text-slate-300 hover:text-rose-500 transition-all">
                <i class="fa-solid fa-circle-xmark text-3xl"></i>
            </button>
            
            <h3 class="text-xl font-black text-slate-800 italic uppercase mb-1 tracking-tighter">Detail Konfirmasi</h3>
            <p id="modalUser" class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mb-6 italic"></p>
            
            <!-- Tempat Gambar Bukti Transfer -->
            <div class="rounded-3xl overflow-hidden bg-slate-50 mb-6 border border-slate-100 flex items-center justify-center p-2 min-h-[300px]">
                <img id="imgBukti" src="" class="max-w-full max-h-80 object-contain rounded-2xl shadow-sm" alt="Bukti Transfer">
            </div>

            <!-- Detail Total Tagihan -->
            <div class="bg-slate-50 p-6 rounded-2xl mb-6 flex justify-between items-center">
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase italic">Total Tagihan</p>
                    <p id="modalTotal" class="text-2xl font-black text-slate-800 italic tracking-tighter"></p>
                </div>
                <i class="fa-solid fa-receipt text-slate-200 text-3xl"></i>
            </div>
            
            <button onclick="closeModal()" class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest italic transition-all shadow-xl shadow-slate-200 hover:bg-slate-800">
                Tutup Preview
            </button>
        </div>
    </div>

    <!-- Script Kontrol Modal -->
    <script>
        function openModal(imgSrc, userName, total) {
            document.getElementById('imgBukti').src = imgSrc;
            document.getElementById('modalUser').innerText = 'Penyewa: ' + userName;
            document.getElementById('modalTotal').innerText = 'Rp ' + total;
            document.getElementById('modalPreview').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Kunci scroll background
        }

        function closeModal() {
            document.getElementById('modalPreview').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Aktifkan kembali scroll background
        }
    </script>
</x-app-layout>