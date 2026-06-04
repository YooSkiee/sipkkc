<x-app-layout>
    <div class="py-12 px-4 max-w-7xl mx-auto">
        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tighter">Daftar Pesanan Masuk</h2>
        
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Penyewa</th>
                        <th class="px-8 py-5">Kamar</th>
                        <th class="px-8 py-5">Bukti Bayar</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    @foreach($bookings as $booking)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-800">{{ $booking->user->name }}</p>
                            <p class="text-[10px] text-slate-400 uppercase font-bold">{{ $booking->created_at->format('d M Y') }}</p>
                        </td>
                        <td class="px-8 py-6 font-bold text-indigo-600">#{{ $booking->kamar->no_kamar }}</td>
                        <td class="px-8 py-6">
                            @if($booking->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}" target="_blank" class="text-indigo-600 font-black text-[10px] uppercase underline">Lihat Bukti</a>
                            @else
                                <span class="text-slate-300 italic">Belum Upload</span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase {{ $booking->status_pembayaran == 'Lunas' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                {{ $booking->status_pembayaran }}
                            </span>
                        </td>
                        <td class="px-8 py-6 flex justify-center gap-3">
                            @if($booking->status_pembayaran == 'Pending')
                                <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="aksi" value="terima">
                                    <button class="bg-emerald-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-lg shadow-emerald-100 hover:scale-105 transition">TERIMA</button>
                                </form>
                                <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="aksi" value="tolak">
                                    <button class="bg-rose-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-lg shadow-rose-100 hover:scale-105 transition">TOLAK</button>
                                </form>
                            @else
                                <span class="text-slate-300 font-bold italic">SELESAI</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>