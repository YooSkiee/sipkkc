<x-app-layout>
    <div class="p-6 sm:p-10 max-w-7xl mx-auto min-h-screen">
        
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-8 bg-indigo-600 rounded-full"></div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Kelola Ulasan</h2>
                    <p class="text-[11px] text-slate-500 font-bold uppercase tracking-widest mt-1">Daftar ulasan dan rating dari penyewa</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto p-4">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-slate-100">
                            <th class="py-4 px-6 text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Penyewa</th>
                            <th class="py-4 px-6 text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Unit Kamar</th>
                            <th class="py-4 px-6 text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Rating</th>
                            <th class="py-4 px-6 text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">Komentar</th>
                            <th class="py-4 px-6 text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($ulasans as $ulasan)
                            <tr class="hover:bg-slate-50/70 transition-colors group">
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-black uppercase shadow-inner">
                                            {{ substr($ulasan->user->name ?? 'P', 0, 1) }}
                                        </div>
                                        <div class="font-bold text-slate-800 text-sm">{{ $ulasan->user->name ?? 'Anonim' }}</div>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <span class="bg-slate-100 text-slate-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-slate-200 shadow-sm">
                                        #{{ $ulasan->kamar->no_kamar ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-1 text-[11px]">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star {{ $i <= $ulasan->rating ? 'text-amber-400 drop-shadow-sm' : 'text-slate-200' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <p class="text-xs text-slate-600 font-medium italic max-w-md leading-relaxed">
                                        "{{ $ulasan->komentar }}"
                                    </p>
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                        {{ $ulasan->created_at->format('d M Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 text-2xl shadow-inner">
                                        <i class="fa-regular fa-comment-dots"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada ulasan masuk.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>