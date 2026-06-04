<x-app-layout>
    <div class="flex min-h-screen bg-slate-50">
        <!-- Main Content Area -->
        <div class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                
                <!-- Header Section -->
                <div class="mb-10 flex justify-between items-end">
                    <div>
                        <h2 class="text-2xl font-black text-slate-800 tracking-tighter italic">Dashboard Overview</h2>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Sistem Informasi Pengelolaan Kos Kosan Cerdas (SIPKKC)</p>
                    </div>
                    <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase italic">Status Server</p>
                        <p class="text-[10px] font-bold text-emerald-500 flex items-center gap-1 uppercase">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> Online
                        </p>
                    </div>
                </div>

                <!-- Statistik Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    
                    <!-- Card 1: Total Pendapatan -->
                    <div class="bg-slate-900 rounded-[2rem] p-7 text-white shadow-xl shadow-slate-200 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-wallet text-5xl"></i>
                        </div>
                        <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-1">Total Pendapatan</p>
                        <h3 class="text-2xl font-black italic tracking-tighter">
                            Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                        </h3>
                        <div class="mt-4 flex items-center gap-2">
                            <span class="bg-emerald-500/20 text-emerald-400 text-[9px] px-2 py-1 rounded-lg font-black uppercase italic">Sudah Lunas</span>
                        </div>
                    </div>

                    <!-- Card 2: Butuh Konfirmasi -->
                    <div class="bg-white rounded-[2rem] p-7 border border-slate-100 shadow-xl shadow-slate-50 relative overflow-hidden group">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1 italic">Butuh Konfirmasi</p>
                        <h3 class="text-3xl font-black text-slate-800 italic">{{ $pesanan_pending }}</h3>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mt-1">Pesanan Menunggu</p>
                        <a href="{{ route('admin.booking.index') }}" class="mt-4 block text-[10px] font-black text-indigo-600 uppercase hover:translate-x-1 transition-transform italic">Cek Sekarang →</a>
                    </div>

                    <!-- Card 3: Kapasitas Kamar -->
                    <div class="bg-white rounded-[2rem] p-7 border border-slate-100 shadow-xl shadow-slate-50 text-center relative overflow-hidden">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1 italic text-left">Kapasitas</p>
                        <div class="flex items-end justify-center gap-1 mt-2">
                            <span class="text-4xl font-black text-indigo-600 leading-none">{{ $kamar_tersedia }}</span>
                            <span class="text-slate-300 font-black mb-1">/ {{ $total_kamar }}</span>
                        </div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mt-2 italic">Kamar Tersedia</p>
                    </div>

                    <!-- Card 4: Quick Action -->
                    <div class="bg-indigo-600 rounded-[2rem] p-7 text-white shadow-xl shadow-indigo-100 flex flex-col justify-center items-center hover:bg-indigo-700 transition-colors group cursor-pointer">
                        <i class="fa-solid fa-plus-circle text-3xl mb-2 group-hover:rotate-90 transition-transform"></i>
                        <p class="text-[10px] font-black uppercase tracking-widest italic text-center leading-tight">Manajemen<br>Kamar</p>
                        <a href="{{ route('admin.kamar.index') }}" class="absolute inset-0"></a>
                    </div>
                </div>

                <!-- Recent Activities & Mini Table -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Pesanan Terbaru -->
                    <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-50 border border-slate-100">
                        <div class="flex justify-between items-center mb-8">
                            <h4 class="font-black text-slate-800 uppercase text-xs tracking-widest italic flex items-center gap-2">
                                <span class="w-2 h-2 bg-indigo-500 rounded-full"></span> Pesanan Terkini
                            </h4>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="border-b border-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <tr>
                                        <th class="pb-4">Penyewa</th>
                                        <th class="pb-4">Kamar</th>
                                        <th class="pb-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-xs">
                                    @foreach($recent_bookings as $booking)
                                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                                        <td class="py-4">
                                            <p class="font-bold text-slate-800 italic">{{ $booking->nama_lengkap }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono">{{ $booking->no_telp }}</p>
                                        </td>
                                        <td class="py-4 font-black text-indigo-600 uppercase italic">#{{ $booking->kamar->no_kamar ?? 'N/A' }}</td>
                                        <td class="py-4">
                                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase italic
                                                {{ $booking->status_pembayaran == 'Lunas' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                                {{ $booking->status_pembayaran }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- List Kamar (Quick View) -->
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-50 border border-slate-100">
                        <h4 class="font-black text-slate-800 uppercase text-xs tracking-widest italic mb-6">Status Kamar</h4>
                        <div class="space-y-4">
                            @foreach($kamars as $k)
                            <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center font-black text-indigo-600 text-xs italic italic">
                                        #{{ $k->no_kamar }}
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-800 italic leading-tight">{{ $k->tipe_kamar }}</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase italic">Rp {{ number_format($k->harga_kamar, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <span class="w-2 h-2 rounded-full {{ $k->status_kamar == 'Tersedia' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>