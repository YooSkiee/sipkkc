<x-app-layout>
    <div class="max-w-7xl mx-auto min-h-screen py-10 px-6 bg-slate-50">
        
        <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4 border-b border-slate-200 pb-6 text-left">
            <div class="text-left">
                <h4 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.4em] mb-1 italic">Manager Dashboard</h4>
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase leading-none">Laporan Transaksi & Sewa</h2>
            </div>
            <div class="flex gap-3">
                <button class="px-5 py-2.5 bg-white border-2 border-slate-200 text-slate-600 rounded-xl font-black text-[10px] uppercase italic tracking-widest hover:border-indigo-400 hover:text-indigo-600 transition-all shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-filter"></i> Filter Bulan
                </button>
                <button class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase italic tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center gap-2" onclick="window.print()">
                    <i class="fa-solid fa-print"></i> Cetak PDF
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-left">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 text-xl">
                    <i class="fa-solid fa-check-double"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic mb-1">Total Transaksi Aktif</p>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">24 <span class="text-xs font-bold text-slate-400">Penyewa</span></h3>
                </div>
            </div>
            </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden text-left">
            <div class="overflow-x-auto p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-slate-100">
                            <th class="py-4 px-4 text-[9px] font-black text-slate-400 uppercase tracking-widest italic text-left"># Invoice</th>
                            <th class="py-4 px-4 text-[9px] font-black text-slate-400 uppercase tracking-widest italic text-left">Data Penyewa</th>
                            <th class="py-4 px-4 text-[9px] font-black text-slate-400 uppercase tracking-widest italic text-left">Unit Kamar</th>
                            <th class="py-4 px-4 text-[9px] font-black text-indigo-500 uppercase tracking-widest italic text-left bg-indigo-50/50 rounded-tl-xl rounded-bl-xl">Masa Sewa</th>
                            <th class="py-4 px-4 text-[9px] font-black text-slate-400 uppercase tracking-widest italic text-center">Catering</th>
                            <th class="py-4 px-4 text-[9px] font-black text-slate-400 uppercase tracking-widest italic text-right">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        {{-- CONTOH DATA (Nanti pakai @foreach($transaksis as $item)) --}}
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="py-4 px-4">
                                <span class="text-xs font-black text-slate-700 tracking-tighter uppercase">INV-001</span>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-1">08 May 2026</p>
                            </td>
                            
                            <td class="py-4 px-4">
                                <span class="text-xs font-black text-slate-800 tracking-tight capitalize">Mario Tondang</span>
                                <p class="text-[9px] font-bold text-slate-500 mt-1"><i class="fa-solid fa-phone text-slate-300 mr-1"></i> 081234567890</p>
                            </td>

                            <td class="py-4 px-4">
                                <div class="inline-flex items-center gap-2 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                                    <i class="fa-solid fa-door-closed text-slate-400 text-[10px]"></i>
                                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">SN08</span>
                                </div>
                            </td>

                            <td class="py-4 px-4 bg-indigo-50/30">
                                <div class="flex flex-col gap-1.5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">IN: 10 May 2026</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                        {{-- NANTI DI KODE ASLI PAKAI INI: --}}
                                        {{-- <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest italic">OUT: {{ \Carbon\Carbon::parse($item->tanggal_masuk)->addMonths($item->durasi_sewa)->format('d M Y') }}</span> --}}
                                        <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest italic">OUT: 10 May 2027</span>
                                    </div>
                                    <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-1 ml-3.5">(Durasi: 12 Bulan)</p>
                                </div>
                            </td>

                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 bg-amber-50 text-amber-600 border border-amber-200 rounded-lg text-[9px] font-black uppercase tracking-widest italic">
                                    <i class="fa-solid fa-utensils mr-1.5"></i> Aktif
                                </span>
                            </td>

                            <td class="py-4 px-4 text-right">
                                <span class="text-sm font-black text-slate-800 font-mono">Rp 9.600.000</span>
                                <p class="text-[8px] font-bold text-emerald-500 uppercase tracking-widest mt-1">Lunas</p>
                            </td>
                        </tr>
                        
                        {{-- Nanti ditutup dengan @endforeach --}}
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-100 bg-slate-50 flex justify-between items-center text-left">
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Menampilkan 1 dari 10 Data</span>
                {{-- Nanti pakai $transaksis->links() dari Laravel --}}
            </div>
        </div>

    </div>
</x-app-layout>