@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-10">
        <h2 class="text-2xl font-bold text-slate-800 mb-8">Update Data Kamar {{ $kamar->no_kamar }}</h2>

        <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- No Kamar -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Kamar</label>
                    <input type="text" name="no_kamar" 
                           value="{{ old('no_kamar', $kamar->no_kamar) }}" 
                           class="w-full px-5 py-4 bg-slate-50 border @error('no_kamar') border-red-500 @else border-slate-200 @enderror rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    
                    <!-- Pesan Error Validasi -->
                    @error('no_kamar')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Ketersediaan (Dropdown) -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Update Ketersediaan</label>
                    <select name="status_kamar" 
                            class="w-full px-5 py-4 bg-slate-50 border @error('status_kamar') border-red-500 @else border-slate-200 @enderror rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition font-semibold">
                        <option value="Tersedia" {{ old('status_kamar', $kamar->status_kamar) == 'Tersedia' ? 'selected' : '' }}>Tersedia (Bisa dipesan)</option>
                        <option value="Terisi" {{ old('status_kamar', $kamar->status_kamar) == 'Terisi' ? 'selected' : '' }}>Terisi (Sudah ada penghuni)</option>
                        <option value="Perbaikan" {{ old('status_kamar', $kamar->status_kamar) == 'Perbaikan' ? 'selected' : '' }}>Perbaikan (Off dari katalog)</option>
                    </select>
                    
                    <!-- Pesan Error Validasi -->
                    @error('status_kamar')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga Sewa (Per Bulan)</label>
                    <input type="number" name="harga_kamar" 
                           value="{{ old('harga_kamar', $kamar->harga_kamar) }}" 
                           class="w-full px-5 py-4 bg-slate-50 border @error('harga_kamar') border-red-500 @else border-slate-200 @enderror rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    
                    <!-- Pesan Error Validasi -->
                    @error('harga_kamar')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 flex gap-4">
                    <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-4 rounded-2xl hover:bg-blue-600 transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.kamar.index') }}" class="flex-1 bg-slate-100 text-slate-600 text-center font-bold py-4 rounded-2xl hover:bg-slate-200 transition">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection