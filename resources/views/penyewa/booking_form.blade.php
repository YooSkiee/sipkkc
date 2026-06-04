<x-app-layout>
    <div class="max-w-4xl mx-auto min-h-screen py-12 px-6 bg-slate-50">
        
        <div class="mb-10 flex justify-between items-end border-b border-slate-200 pb-8 text-left">
            <div class="text-left">
                <h4 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.4em] mb-2 italic text-left">Booking Process</h4>
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase leading-none text-left">Formulir Penyewaan</h2>
            </div>
            <div class="text-right">
                <span class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase italic shadow-lg">Step 1 of 2</span>
            </div>
        </div>

        {{-- ALERT ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="mb-8 p-6 bg-rose-50 border border-rose-200 rounded-3xl">
                <div class="flex items-center gap-3 mb-2 text-left">
                    <i class="fa-solid fa-triangle-exclamation text-rose-500"></i>
                    <h3 class="text-xs font-black text-rose-600 uppercase tracking-widest">Gagal Menyimpan Data!</h3>
                </div>
                <ul class="list-disc list-inside text-[10px] font-bold text-rose-500 uppercase tracking-wider text-left">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penyewa.booking.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-12 text-left">
            @csrf
            {{-- ID Kamar wajib dikirim --}}
            <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">

            <div class="space-y-6 text-left">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                        <i class="fa-solid fa-user-check text-xs"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest italic">Informasi Personal</h3>
                </div>

                <div class="text-left">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-2 text-left">Nama Lengkap</label>
                    {{-- name="nama_lengkap" sesuai validasi --}}
                    <input type="text" name="nama_lengkap" value="{{ auth()->user()->name }}" class="w-full bg-white border-slate-100 rounded-2xl p-4 text-sm font-bold text-slate-800 shadow-sm focus:ring-2 focus:ring-indigo-500 opacity-70 cursor-not-allowed" readonly>
                </div>

                <div class="text-left">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-2 text-left">Nomor Telepon / WA</label>
                    {{-- name="no_telp" sesuai validasi --}}
                    <input type="text" name="no_telp" class="w-full bg-white border-slate-100 rounded-2xl p-4 text-sm font-bold text-slate-800 shadow-sm focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: 083298890887" value="{{ old('no_telp') }}" required>
                </div>

                <div class="text-left">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-2 text-left">Alamat Asal</label>
                    {{-- name="alamat_asal" sesuai validasi --}}
                    <textarea name="alamat_asal" rows="3" class="w-full bg-white border-slate-100 rounded-2xl p-4 text-sm font-bold text-slate-800 shadow-sm focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan alamat sesuai KTP..." required>{{ old('alamat_asal') }}</textarea>
                </div>
            </div>

            <div class="space-y-6 text-left">
                <div class="bg-indigo-600 p-8 rounded-[3rem] shadow-xl shadow-indigo-100 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:rotate-12 transition-transform duration-700">
                        <i class="fa-solid fa-door-open text-8xl text-white"></i>
                    </div>
                    <div class="relative z-10 text-left">
                        <p class="text-[9px] font-black text-indigo-200 uppercase tracking-[0.3em] mb-2 italic text-left">Unit Terpilih</p>
                        <h3 class="text-2xl font-black text-white italic tracking-tighter uppercase text-left">No. Kamar: {{ $kamar->no_kamar }}</h3>
                        <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-tighter italic text-left mt-1">{{ $kamar->tipe_kamar }} — Rp {{ number_format($kamar->harga_kamar, 0, ',', '.') }}/BLN</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 text-left">
                    <div class="text-left">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic mb-2 text-left">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" class="w-full bg-white border-slate-100 rounded-2xl p-4 text-sm font-bold text-slate-700 shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div class="text-left">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic mb-2 text-left">Durasi (Bulan)</label>
                        <input type="number" name="durasi_sewa" value="{{ old('durasi_sewa') }}" min="1" class="w-full bg-white border-slate-100 rounded-2xl p-4 text-sm font-bold text-slate-700 shadow-sm focus:ring-2 focus:ring-indigo-500" placeholder="Cth: 12" required>
                    </div>
                </div>

                <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex items-center justify-between group hover:border-indigo-200 transition-all text-left">
                    <div class="flex items-center gap-4 text-left">
                        <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                            <i class="fa-solid fa-utensils text-xs"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="text-xs font-black text-slate-800 tracking-tight uppercase italic text-left">Paket Catering</h4>
                            <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5 text-left">Include Daily Meals?</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="include_catering" value="1" class="sr-only peer" {{ old('include_catering') ? 'checked' : '' }}>
                        <div class="w-12 h-6 bg-slate-200 rounded-full peer peer-checked:bg-indigo-600 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all shadow-inner transition-all"></div>
                    </label>
                </div>

                <div class="pt-6 space-y-3 text-left">
                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] italic hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200 active:scale-95">
                        Simpan & Pilih Catering
                    </button>
                    <a href="{{ route('penyewa.menu') }}" class="block w-full text-center py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest italic hover:text-slate-600 transition-colors">
                        [ Batalkan Pemesanan ]
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>