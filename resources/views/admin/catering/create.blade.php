@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-2xl mx-auto">
    <h3 class="text-2xl font-bold text-slate-800 mb-6">Tambah Menu Catering</h3>
    
    <form action="{{ route('admin.catering.store') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">NAMA MENU</label>
            <input type="text" name="nama_menu" value="{{ old('nama_menu') }}" class="w-full bg-slate-50 border @error('nama_menu') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Contoh: Paket Ayam Bakar" required>
            @error('nama_menu')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">JADWAL HARI</label>
            <select name="hari" class="w-full bg-slate-50 border @error('hari') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                <option value="" disabled {{ old('hari') ? '' : 'selected' }}>Pilih Hari</option>
                <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
            </select>
            @error('hari')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">HARGA (Rp)</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="w-full bg-slate-50 border @error('harga') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Misal: 15000" required>
            @error('harga')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">DESKRIPSI MENU (OPSIONAL)</label>
            <textarea name="deskripsi" rows="3" class="w-full bg-slate-50 border @error('deskripsi') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Contoh: Nasi, Ayam Bakar, Lalapan, Es Teh">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('admin.catering.index') }}" class="py-3 px-6 text-sm font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
            <button type="submit" class="bg-[#1A237E] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg hover:bg-blue-800 transition">Simpan Menu</button>
        </div>
    </form>
</div>
@endsection