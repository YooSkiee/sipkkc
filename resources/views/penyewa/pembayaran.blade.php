<x-app-layout>
    <x-slot name="header">Ringkasan & Pembayaran</x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4">
        {{-- Form menggunakan route store dan nama kolom bukti_transfer sesuai database --}}
        <form action="{{ route('penyewa.booking.pembayaran.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Sisi Kiri: Ringkasan Tagihan (Slim Design) -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-full -mr-12 -mt-12 opacity-40"></div>

                    <h3 class="font-black text-slate-900 uppercase text-[10px] tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-md bg-indigo-600 flex items-center justify-center text-white shadow-md">
                            <i class="fa-solid fa-receipt text-[8px]"></i>
                        </span>
                        Detail Tagihan
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Unit Sewa -->
                        <div class="flex justify-between items-center pb-3 border-b border-dashed border-slate-100">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-0.5">Unit Sewa</p>
                                <p class="text-xs font-bold text-slate-800 italic">Kamar #{{ $booking->kamar->nomor_kamar ?? $booking->kamar->no_kamar }} ({{ $booking->durasi_sewa }} Bln)</p>
                            </div>
                            <span class="text-xs font-black text-slate-700 italic font-mono">Rp {{ number_format($biayaKamar, 0, ',', '.') }}</span>
                        </div>
                        
                        <!-- Add-on Catering -->
                        @if($booking->paket_catering)
                        <div class="flex justify-between items-center pb-3 border-b border-dashed border-slate-100">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-0.5">Add-on</p>
                                <p class="text-xs font-bold text-slate-800 italic">Catering ({{ $booking->paket_catering }} - {{ $booking->durasi_catering }} Bln)</p>
                            </div>
                            <span class="text-xs font-black text-emerald-600 italic font-mono">+ Rp {{ number_format($biayaCatering, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        <!-- Total Tagihan -->
                        <div class="pt-2 flex justify-between items-end">
                            <p class="font-black uppercase text-[9px] text-indigo-500 italic">Total Bayar</p>
                            <span class="text-2xl font-black text-indigo-600 tracking-tighter italic">
                                <span class="text-xs">Rp</span> {{ number_format($booking->total_biaya, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Info Rekening (Compact) -->
                    <div class="mt-8 bg-slate-900 p-6 rounded-2xl text-white">
                        <p class="text-[8px] font-black text-slate-500 uppercase mb-3 tracking-widest italic text-center sm:text-left">Transfer Rekening</p>
                        <div class="flex items-center gap-4">
                            <div class="bg-indigo-600 p-2.5 rounded-xl">
                                <i class="fa-solid fa-building-columns text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase">Bank BCA</p>
                                <p class="text-lg font-mono font-bold tracking-tighter">123-456-7890</p>
                                <p class="text-[8px] font-bold text-slate-400 mt-0.5 uppercase italic">a/n Mario Tondang</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Upload Bukti -->
                <div class="bg-white rounded-[2rem] shadow-lg border border-slate-100 p-8 flex flex-col justify-between">
                    <div>
                        <h3 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-6 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-emerald-500 flex items-center justify-center text-white shadow-md">
                                <i class="fa-solid fa-camera text-[8px]"></i>
                            </span>
                            Bukti Transfer
                        </h3>
                        
                        {{-- Dropzone Area --}}
                        <div class="relative h-48 w-full border-2 border-dashed border-slate-100 rounded-2xl bg-slate-50/50 hover:border-indigo-300 transition-all overflow-hidden group">
                            {{-- Input File dibuat menutupi seluruh kotak dengan z-index tinggi --}}
                            <input type="file" name="bukti_transfer" id="bukti_transfer" required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50"
                                onchange="previewImage(this)">
                                
                            <div id="dropzone-content" class="absolute inset-0 flex flex-col items-center justify-center p-4 z-10">
                                <div id="preview-container" class="hidden mb-2">
                                    <img id="image-preview" src="#" alt="Preview" class="max-h-32 rounded-xl shadow-lg border-2 border-white mx-auto">
                                </div>
                                
                                <div id="upload-icon-box" class="flex flex-col items-center group-hover:scale-110 transition-transform">
                                    <div class="bg-white text-indigo-500 w-12 h-12 rounded-xl shadow-md flex items-center justify-center text-xl mb-3">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                    <p id="upload-text" class="text-[9px] font-black text-slate-400 uppercase text-center italic">
                                        Klik Kotak Ini untuk <span class="text-indigo-600 font-black">Pilih Foto</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p class="text-[8px] text-slate-300 mt-2 text-center font-bold italic">*Format: JPG, PNG (Max 2MB)</p>
                    </div>

                    {{-- Tombol Konfirmasi (Slim & Modern) --}}
                    <button type="submit" class="w-full mt-8 bg-indigo-600 text-white font-black py-4 rounded-xl hover:bg-indigo-700 active:scale-95 transition-all shadow-md uppercase tracking-widest text-[10px] italic">
                        Konfirmasi Pembayaran <i class="fa-solid fa-paper-plane ml-1"></i>
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- Script Preview Gambar -->
    <script>
        function previewImage(input) {
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('image-preview');
            const uploadIconBox = document.getElementById('upload-icon-box');
            const uploadText = document.getElementById('upload-text');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    previewImage.style.display = 'block'; 
                    
                    if(uploadIconBox) uploadIconBox.classList.add('hidden');
                    
                    uploadText.innerHTML = `<span class="text-emerald-600 font-black uppercase text-[10px]">File Berhasil Dipilih!</span>`;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>