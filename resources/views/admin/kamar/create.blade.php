@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-2xl mx-auto">
    <h3 class="text-2xl font-bold text-slate-800 mb-6">Tambah Data Kamar</h3>
    
    <form action="{{ route('admin.kamar.store') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 space-y-6">
        @csrf
        
        <!-- Nomor Kamar -->
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Kamar</label>
            <input type="text" name="no_kamar" value="{{ old('no_kamar') }}" class="w-full bg-slate-50 border @error('no_kamar') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Contoh: V04" required>
            @error('no_kamar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tipe Kamar -->
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Tipe Kamar</label>
            <select name="tipe_kamar" class="w-full bg-slate-50 border @error('tipe_kamar') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition font-semibold" required>
                <option value="" disabled {{ old('tipe_kamar') ? '' : 'selected' }}>Pilih Tipe Kamar</option>
                <option value="Standard" {{ old('tipe_kamar') == 'Standard' ? 'selected' : '' }}>Standard</option>
                <option value="Deluxe" {{ old('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="VIP" {{ old('tipe_kamar') == 'VIP' ? 'selected' : '' }}>VIP</option>
            </select>
            @error('tipe_kamar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Sewa -->
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Harga Sewa (Per Bulan)</label>
            <input type="number" name="harga_kamar" value="{{ old('harga_kamar') }}" class="w-full bg-slate-50 border @error('harga_kamar') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Misal: 1500000 (Tanpa Titik)" required>
            @error('harga_kamar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fasilitas -->
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Fasilitas (Opsional)</label>
            <textarea name="fasilitas" rows="3" class="w-full bg-slate-50 border @error('fasilitas') border-red-500 @else border-slate-200 @enderror rounded-xl py-3 px-4 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Contoh: AC, Kamar Mandi Dalam, Kasur, Lemari">{{ old('fasilitas') }}</textarea>
            @error('fasilitas')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('admin.kamar.index') }}" class="py-3 px-6 text-sm font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
            <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg hover:bg-blue-600 transition">
                Simpan Kamar
            </button>
        </div>
    </form>
</div>
@endsection