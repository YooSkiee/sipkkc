@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Header Tabel -->
    <div class="p-8 border-b border-slate-50 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Kamar</h2>
            <p class="text-slate-400 text-sm font-medium">Kelola informasi dan status ketersediaan unit Kos Ginting</p>
        </div>
        <a href="{{ route('admin.kamar.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-700 transition flex items-center gap-2 shadow-lg shadow-blue-100">
            <i class="fas fa-plus text-xs"></i> Tambah Kamar Baru
        </a>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
    <div class="mx-8 mt-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Tabel Data -->
    <div class="overflow-x-auto p-4">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-400 text-[11px] font-bold uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-5 rounded-l-2xl">No. Kamar</th>
                    <th class="px-6 py-5">Tipe Kamar</th>
                    <th class="px-6 py-5 text-right">Harga Sewa</th>
                    <th class="px-6 py-5 text-center">Status</th>
                    <th class="px-6 py-5 text-center rounded-r-2xl">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($kamars as $kamar)
                <tr class="group hover:bg-slate-50/50 transition duration-200">
                    <td class="px-6 py-6">
                        <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-lg font-bold text-sm">
                            {{ $kamar->no_kamar }}
                        </span>
                    </td>
                    <td class="px-6 py-6">
                        <p class="font-bold text-slate-800">{{ $kamar->tipe_kamar }}</p>
                        <p class="text-[10px] text-slate-400 truncate max-w-[200px]">{{ $kamar->fasilitas }}</p>
                    </td>
                    <td class="px-6 py-6 text-right">
                        <span class="text-blue-600 font-black text-sm">
                            Rp {{ number_format($kamar->harga_kamar, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="px-6 py-6 text-center">
                        @if($kamar->status_kamar == 'Tersedia')
                            <span class="bg-green-100 text-green-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">
                                {{ $kamar->status_kamar }}
                            </span>
                        @elseif($kamar->status_kamar == 'Terisi')
                            <span class="bg-orange-100 text-orange-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">
                                {{ $kamar->status_kamar }}
                            </span>
                        @else
                            <span class="bg-red-100 text-red-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">
                                {{ $kamar->status_kamar }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex justify-center items-center gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-400 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus Kamar {{ $kamar->no_kamar }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-400 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-door-closed text-5xl text-slate-100 mb-4"></i>
                            <p class="text-slate-400 font-medium italic">Belum ada data kamar yang terdaftar.</p>
                            <p class="text-slate-300 text-xs mt-1">Gunakan tombol "+ Tambah Kamar Baru" untuk memulai.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection