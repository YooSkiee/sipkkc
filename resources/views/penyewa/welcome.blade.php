<x-app-layout>
    <!-- Font Awesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="py-12 bg-[#F8FAFC] min-h-[90vh] flex items-center">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-10 md:p-20 relative overflow-hidden">
                
                <!-- Hiasan Background (Opsional) -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-blue-50 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <!-- Icon Utama -->
                    <div class="bg-indigo-600 w-24 h-24 rounded-[2rem] flex items-center justify-center mx-auto mb-10 shadow-2xl shadow-indigo-200 transform hover:scale-110 transition-transform duration-500">
                        <i class="fa-solid fa-house-chimney-window text-4xl text-white"></i>
                    </div>

                    <!-- Judul Utama -->
                    <h1 class="text-4xl md:text-6xl font-black text-slate-800 uppercase tracking-tight mb-6">
                        Selamat Datang di <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">KOS GINTING</span>
                    </h1>
                    
                    <p class="text-slate-500 text-lg mb-12 max-w-2xl mx-auto leading-relaxed font-medium">
                        Temukan kenyamanan hunian terbaik di kota ini. Sistem kami membantu Anda mencari, memilih, dan memesan kamar dengan lebih mudah, cepat, dan transparan.
                    </p>

                    <!-- Tombol Aksi Utama -->
                    <div class="flex flex-col md:flex-row justify-center items-center gap-6">
                        <a href="{{ route('penyewa.menu') }}" 
                        class="group relative inline-flex items-center gap-4 bg-slate-900 hover:bg-indigo-600 text-white font-black py-6 px-12 rounded-2xl text-xs tracking-[0.2em] transition-all shadow-2xl hover:shadow-indigo-200 uppercase w-full md:w-auto justify-center">
                            <span>Mulai Cari Kamar</span>
                            <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                        </a>

                        <a href="{{ route('penyewa.riwayat') }}" 
                        class="inline-flex items-center gap-4 bg-white border-2 border-slate-100 hover:border-indigo-600 text-slate-600 hover:text-indigo-600 font-black py-6 px-12 rounded-2xl text-xs tracking-[0.2em] transition-all uppercase w-full md:w-auto justify-center">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            Cek Riwayat Saya
                        </a>
                    </div>
                    
                    <!-- Footer Kecil -->
                    <div class="mt-16 flex items-center justify-center gap-8 border-t border-slate-50 pt-10">
                        <div class="text-center">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Project</p>
                            <p class="text-xs font-bold text-slate-600 uppercase">SIPKKC 2026</p>
                        </div>
                        <div class="w-px h-8 bg-slate-100"></div>
                        <div class="text-center">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Developer</p>
                            <p class="text-xs font-bold text-slate-600 uppercase">Mario Tondang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>