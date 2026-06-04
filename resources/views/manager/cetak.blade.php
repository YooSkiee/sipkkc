<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-8 bg-white min-h-screen">
        
        <div class="flex justify-between items-start border-b-4 border-slate-900 pb-8 mb-10">
            <div class="text-left">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">LAPORAN EKSEKUTIF</h1>
                <p class="text-sm font-bold text-slate-500 uppercase tracking-[0.3em] mt-1">Sistem Informasi SIPKKC — Kos Ginting</p>
                <p class="text-[10px] font-bold text-slate-400 mt-2 italic text-left">Dicetak pada: {{ $tgl_cetak }}</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Periode Laporan</p>
                <p class="text-2xl font-black text-slate-900 italic uppercase">{{ date('Y') }}</p>
            </div>
        </div>

        <div class="mb-10 p-8 bg-slate-50 rounded-[2rem] border border-slate-100 flex justify-between items-center">
            <div class="text-left">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1 italic text-left">Total Pendapatan Bersih</h4>
                <p class="text-3xl font-black text-indigo-600 tracking-tighter font-mono text-left">
                    Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                </p>
            </div>
            <div class="text-right">
                <button onclick="window.print()" class="print:hidden bg-slate-900 text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase italic tracking-widest shadow-xl hover:bg-indigo-600 transition-all">
                    <i class="fa-solid fa-print mr-2"></i> Cetak Dokumen
                </button>
            </div>
        </div>

        <div class="text-left mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-8 bg-indigo-600 rounded-full"></div>
                <h3 class="text-xl font-black text-slate-800 tracking-tight uppercase italic text-left">Riwayat Penyewaan Kamar</h3>
            </div>

            <div class="overflow-hidden border border-slate-200 rounded-[1.5rem]">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100 border-b border-slate-200">
                            <th class="py-4 px-4 text-[10px] font-black text-slate-600 uppercase tracking-widest italic">No</th>
                            <th class="py-4 px-4 text-[10px] font-black text-slate-600 uppercase tracking-widest italic text-left">Nama Penyewa</th>
                            <th class="py-4 px-4 text-[10px] font-black text-slate-600 uppercase tracking-widest italic text-left">Unit Kamar</th>
                            <th class="py-4 px-4 text-[10px] font-black text-indigo-600 uppercase tracking-widest italic text-left">Tgl Masuk</th>
                            <th class="py-4 px-4 text-[10px] font-black text-rose-600 uppercase tracking-widest italic text-left">Tgl Berakhir</th>
                            <th class="py-4 px-4 text-[10px] font-black text-slate-600 uppercase tracking-widest italic text-left">Durasi</th>
                            <th class="py-4 px-4 text-[10px] font-black text-slate-600 uppercase tracking-widest italic text-right">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic font-bold uppercase tracking-tight">
                        @foreach($riwayat as $index => $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 text-xs text-slate-400">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 text-[11px] text-slate-800 font-black tracking-tight text-left">
                                {{ $item->nama_lengkap ?? ($item->user->name ?? '-') }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-slate-600 text-left">
                                {{ $item->kamar->no_kamar ?? '-' }} ({{ $item->kamar->tipe_kamar ?? '-' }})
                            </td>
                            <td class="py-4 px-4 text-[11px] text-slate-700 text-left">
                                {{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-rose-600 font-black text-left">
                                {{ \Carbon\Carbon::parse($item->tanggal_masuk)->addMonths($item->durasi_sewa)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-slate-600 text-left">
                                {{ $item->durasi_sewa }} Bulan
                            </td>
                            <td class="py-4 px-4 text-[11px] text-slate-800 font-mono text-right">
                                Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-left">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-8 bg-emerald-500 rounded-full"></div>
                <h3 class="text-xl font-black text-slate-800 tracking-tight uppercase italic text-left">Daftar Pelanggan Catering Aktif</h3>
            </div>

            <div class="overflow-hidden border border-slate-200 rounded-[1.5rem]">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 border-b border-emerald-100">
                            <th class="py-4 px-4 text-[10px] font-black text-emerald-700 uppercase tracking-widest italic">No</th>
                            <th class="py-4 px-4 text-[10px] font-black text-emerald-700 uppercase tracking-widest italic text-left">Nama Pelanggan</th>
                            <th class="py-4 px-4 text-[10px] font-black text-emerald-700 uppercase tracking-widest italic text-left">Paket Catering</th>
                            <th class="py-4 px-4 text-[10px] font-black text-indigo-600 uppercase tracking-widest italic text-left">Tgl Mulai</th>
                            <th class="py-4 px-4 text-[10px] font-black text-rose-600 uppercase tracking-widest italic text-left">Tgl Berakhir</th>
                            <th class="py-4 px-4 text-[10px] font-black text-emerald-700 uppercase tracking-widest italic text-left">Durasi</th>
                            <th class="py-4 px-4 text-[10px] font-black text-emerald-700 uppercase tracking-widest italic text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic font-bold uppercase tracking-tight">
                        @forelse($data_catering as $index => $cat)
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="py-4 px-4 text-xs text-slate-400">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 text-[11px] text-slate-800 font-black tracking-tight text-left">
                                {{ $cat->user->name ?? '-' }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-emerald-600 font-black text-left">
                                <i class="fa-solid fa-utensils mr-2 text-[9px]"></i> {{ $cat->paket_catering }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-slate-700 text-left">
                                {{ \Carbon\Carbon::parse($cat->tanggal_masuk)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-rose-600 font-black text-left">
                                {{ \Carbon\Carbon::parse($cat->tanggal_masuk)->addMonths($cat->durasi_sewa)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 text-[11px] text-slate-600 text-left">
                                {{ $cat->durasi_sewa }} Bulan
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-600 text-[8px] font-black rounded-lg uppercase tracking-widest">
                                    Aktif
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest italic">
                                Belum ada pelanggan catering aktif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-20 flex justify-end">
            <div class="text-center w-64 border-t-2 border-slate-900 pt-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic mb-12">Authorized Manager</p>
                <p class="text-sm font-black text-slate-900 underline uppercase italic">{{ auth()->user()->name }}</p>
                <p class="text-[8px] font-bold text-slate-400 mt-1 uppercase tracking-widest">Kos Ginting Management System</p>
            </div>
        </div>

    </div>

    {{-- CSS TAMBAHAN UNTUK PRINT --}}
    <style>
        /* Menghilangkan Header (URL) dan Footer (Tanggal) bawaan browser */
        @page {
            size: A4;
            margin: 0; 
        }

        @media print {
            body { 
                background-color: white !important; 
                padding: 1.5cm !important; /* Memberi margin aman ke dalam dokumen */
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; /* Memaksa warna background/tabel tercetak */
            }
            .print\:hidden { display: none !important; }
            nav, footer, aside { display: none !important; }
            .max-w-7xl { max-width: 100% !important; padding: 0 !important; margin: 0 !important; }
        }
    </style>
</x-app-layout>