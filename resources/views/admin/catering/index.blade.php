@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-black text-slate-800 tracking-tighter italic uppercase">Manajemen Catering</h2>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest italic">Kelola paket & menu harian</p>
        </div>
        <a href="{{ route('admin.catering.create') }}" 
            class="bg-indigo-600 text-white px-4 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-md italic inline-block">
            + Tambah Menu
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-indigo-600 rounded-3xl p-5 text-white shadow-lg relative overflow-hidden h-28 flex items-center">
            <div class="relative z-10">
                <p class="text-[8px] font-black uppercase opacity-60 tracking-widest italic">Paket 1</p>
                <h3 class="text-lg font-black italic tracking-tighter">Ekonomis</h3>
                <p class="text-md font-bold font-mono">Rp 900.000 <span class="text-[8px] opacity-60">/ BLN</span></p>
            </div>
            <i class="fa-solid fa-bowl-food absolute right-6 text-4xl opacity-10"></i>
        </div>
        
        <div class="bg-slate-900 rounded-3xl p-5 text-white shadow-lg relative overflow-hidden h-28 flex items-center border border-slate-800">
            <div class="relative z-10">
                <p class="text-[8px] font-black uppercase opacity-40 tracking-widest italic">Paket 2</p>
                <h3 class="text-lg font-black italic tracking-tighter text-indigo-400">Premium</h3>
                <p class="text-md font-bold font-mono">Rp 1.000.000 <span class="text-[8px] opacity-40">/ BLN</span></p>
            </div>
            <i class="fa-solid fa-utensils absolute right-6 text-4xl opacity-10 text-indigo-500"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white rounded-[2rem] p-6 shadow-xl shadow-slate-100 border border-slate-50">
            <h3 class="font-black text-slate-800 text-[10px] uppercase tracking-widest mb-4 flex items-center gap-2 italic">
                <span class="w-2 h-2 bg-indigo-500 rounded-full"></span> Rincian Menu Seminggu
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @forelse($caterings as $menu)
                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl hover:bg-white hover:shadow-md transition-all group border-l-2 border-l-indigo-500">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[8px] font-black text-indigo-600 uppercase italic bg-indigo-50 px-2 py-0.5 rounded-md">{{ $menu->hari }}</span>
                        <form action="{{ route('admin.catering.destroy', $menu->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-slate-300 hover:text-rose-500 transition-all">
                                <i class="fa-solid fa-xmark text-[10px]"></i>
                            </button>
                        </form>
                    </div>
                    <h4 class="font-black text-slate-800 text-xs italic">{{ $menu->nama_menu }}</h4>
                    <p class="text-[9px] text-slate-400 mt-1 line-clamp-1 italic">{{ $menu->deskripsi }}</p>
                </div>
                @empty
                <div class="col-span-2 py-8 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    <p class="text-[9px] font-black text-slate-300 uppercase italic">Belum ada data menu</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-slate-900 rounded-[2rem] p-6 shadow-xl text-white">
            <h3 class="font-black text-slate-500 text-[9px] uppercase tracking-widest mb-4 italic">Pelanggan Aktif</h3>
            <div class="space-y-3">
                @forelse($pemesan as $p)
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/10">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center font-black text-[10px] italic shadow-lg shadow-indigo-900/50">
                        #{{ $p->kamar->no_kamar ?? '?' }}
                    </div>
                    <div>
                        <p class="text-[10px] font-black italic tracking-tight">{{ $p->nama_lengkap }}</p>
                        <p class="text-[8px] font-bold text-indigo-400 uppercase">{{ $p->paket_catering }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-10 opacity-20">
                    <i class="fa-solid fa-user-slash text-xl mb-2"></i>
                    <p class="text-[8px] font-black uppercase tracking-widest">Kosong</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection