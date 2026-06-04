<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kos Ginting - Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white font-sans antialiased">

    <header class="border-b border-slate-100 py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="bg-blue-600 p-2 rounded-xl text-white">
                    <i class="fas fa-home text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-800 uppercase">Kos Ginting</h1>
                    <p class="text-[10px] text-slate-400 font-medium tracking-widest uppercase">Management System</p>
                </div>
            </div>

            <nav class="flex items-center gap-10">
                {{-- Link dinamis untuk Katalog dan Riwayat --}}
                <a href="{{ route('penyewa.menu') }}" 
                   class="text-sm font-bold {{ request()->routeIs('penyewa.menu') ? 'text-slate-800 border-b-2 border-blue-600' : 'text-slate-400' }} pb-1 hover:text-slate-800 transition">
                   KATALOG
                </a>
                <a href="{{ route('penyewa.riwayat') }}" 
                   class="text-sm font-bold {{ request()->routeIs('penyewa.riwayat') ? 'text-slate-800 border-b-2 border-blue-600' : 'text-slate-400' }} pb-1 hover:text-slate-800 transition">
                   RIWAYAT
                </a>
            </nav>

            <div class="flex items-center gap-4 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100">
                <div class="text-right">
                    {{-- PERBAIKAN: Nama diambil dari database user yang sedang login --}}
                    <p class="text-xs font-bold text-slate-800">
                        {{ Auth::user()->name }}
                    </p>
                    {{-- PERBAIKAN: Role diambil otomatis (Penyewa/Admin/Manager) --}}
                    <p class="text-[9px] font-bold text-blue-600 uppercase">
                        {{ Auth::user()->role }}
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors">
                        <i class="fas fa-sign-out-alt text-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>