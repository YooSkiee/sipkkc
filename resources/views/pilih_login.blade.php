<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Kos Ginting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .mesh-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-color: #ffffff;
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
            filter: blur(80px);
            opacity: 0.1;
        }
        .card-choice {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-choice:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="mesh-bg"></div>

    <div class="w-full max-w-5xl">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-900 rounded-2xl mb-6 shadow-xl">
                <i class="fa-solid fa-hotel text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">KOS GINTING</h1>
            <p class="text-slate-500 font-medium mt-2">Sistem Informasi Manajemen Hunian Terintegrasi</p>
        </div>

        <!-- Pilihan Role -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Link Penyewa dengan parameter role -->
            <a href="{{ route('login', ['role' => 'penyewa']) }}" class="card-choice group bg-white p-10 rounded-[2.5rem] border border-slate-100 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800">Penyewa</h2>
                <p class="text-sm text-slate-500 mt-3 leading-relaxed">Masuk untuk melihat katalog kamar, booking, dan cek pembayaran.</p>
                <div class="mt-8 py-2 px-6 rounded-full border border-blue-100 text-blue-600 text-xs font-bold uppercase tracking-wider group-hover:bg-blue-600 group-hover:text-white transition-all">
                    Masuk Portal
                </div>
            </a>

            <!-- Link Admin dengan parameter role -->
            <a href="{{ route('login', ['role' => 'admin']) }}" class="card-choice group bg-white p-10 rounded-[2.5rem] border border-slate-100 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-rose-600 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800">Admin</h2>
                <p class="text-sm text-slate-500 mt-3 leading-relaxed">Kelola data kamar, konfirmasi booking, dan manajemen sewa.</p>
                <div class="mt-8 py-2 px-6 rounded-full border border-rose-100 text-rose-600 text-xs font-bold uppercase tracking-wider group-hover:bg-rose-600 group-hover:text-white transition-all">
                    Panel Admin
                </div>
            </a>

            <!-- Link Manager dengan parameter role -->
            <a href="{{ route('login', ['role' => 'manager']) }}" class="card-choice group bg-white p-10 rounded-[2.5rem] border border-slate-100 flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800">Manager</h2>
                <p class="text-sm text-slate-500 mt-3 leading-relaxed">Pantau laporan keuangan, statistik hunian, dan evaluasi performa.</p>
                <div class="mt-8 py-2 px-6 rounded-full border border-emerald-100 text-emerald-600 text-xs font-bold uppercase tracking-wider group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    Laporan Bisnis
                </div>
            </a>

        </div>

        <!-- Footer -->
        <div class="mt-20 text-center">
            <div class="h-px w-24 bg-slate-200 mx-auto mb-6"></div>
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">
                &copy; 2026 Kos Ginting Digital Ecosystem
            </p>
        </div>
    </div>

</body>
</html>