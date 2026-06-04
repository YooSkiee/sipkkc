<x-app-layout>
    <!-- Font Awesome untuk Icon Panah -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- TOMBOL KEMBALI KE MENU TIPE -->
            <div class="mb-8">
                <a href="{{ route('penyewa.menu') }}" class="group inline-flex items-center gap-3 text-slate-500 hover:text-indigo-600 transition-all">
                    <div class="w-10 h-10 rounded-full bg-white shadow-sm border border-slate-200 flex items-center justify-center group-hover:border-indigo-600 group-hover:bg-indigo-50 transition-all">
                        <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                    </div>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">Kembali Pilih Tipe Kamar</span>
                </a>
            </div>

            <!-- JUDUL HALAMAN -->
            <div class="flex items-center gap-4 mb-10">
                <div class="w-1.5 h-10 bg-indigo-600 rounded-full"></div>
                <h2 class="text-2xl md:text-3xl font-black text-slate-800 uppercase tracking-tight">
                    Katalog Kamar Tipe: <span class="text-indigo-600">{{ $tipe }}</span>
                </h2>
            </div>

            <!-- GRID DAFTAR KAMAR -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($kamars as $item)
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden group hover:shadow-xl hover:shadow-indigo-100 transition-all duration-500">
                        <!-- Header Card -->
                        <div class="bg-gradient-to-r from-orange-400 to-amber-500 p-6 flex justify-between items-center text-white">
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-80">{{ $item->tipe_kamar }}</span>
                            <span class="text-sm font-black uppercase tracking-tighter">#{{ $item->no_kamar }}</span>
                        </div>

                        <!-- Isi Card -->
                        <div class="p-8">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Biaya Sewa</p>
                            <div class="flex items-baseline gap-1 mb-8">
                                <h3 class="text-3xl font-black text-slate-800 italic">Rp {{ number_format($item->harga_kamar, 0, ',', '.') }}</h3>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">/ Bulan</span>
                            </div>

                            <div class="bg-orange-50 rounded-2xl p-6 mb-8 border border-orange-100">
                                <p class="text-xs leading-relaxed text-amber-800 font-medium italic text-center">
                                    <i class="fa-solid fa-quote-left opacity-30 mr-2"></i>
                                    {{ $item->fasilitas }}
                                    <i class="fa-solid fa-quote-right opacity-30 ml-2"></i>
                                </p>
                            </div>

                            <!-- Tombol Sewa -->
                            <a href="{{ route('penyewa.booking.form', $item->id) }}" 
                               class="flex items-center justify-center gap-3 w-full bg-indigo-600 hover:bg-slate-900 text-white font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-indigo-100">
                                <i class="fa-solid fa-file-signature text-sm"></i>
                                Sewa Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Jika Kamar Kosong -->
                    <div class="col-span-full py-20 text-center">
                        <div class="bg-slate-200 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa-solid fa-bed text-2xl text-slate-400"></i>
                        </div>
                        <h3 class="text-slate-500 font-bold uppercase tracking-widest">Maaf, Kamar Tipe Ini Belum Tersedia</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>