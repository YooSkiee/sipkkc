<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kos Ginting</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 min-h-screen sticky top-0 shadow-xl">
            <div class="p-6 flex items-center gap-3 border-b border-slate-800">
                <div class="bg-blue-600 p-2 rounded-lg text-white">
                    <i class="fas fa-home"></i>
                </div>
                <h1 class="text-white font-bold tracking-wider">KOS GINTING</h1>
            </div>
            <nav class="mt-8 px-4 space-y-2">
                <a href="/admin/dashboard" class="flex items-center gap-3 text-white bg-blue-600 px-4 py-3 rounded-xl transition">
                    <i class="fas fa-chart-line w-5"></i> Dashboard
                </a>
                <a href="/admin/kamar" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                    <i class="fas fa-door-open w-5"></i> Manajemen Kamar
                </a>
                <a href="/admin/pesanan" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800 px-4 py-3 rounded-xl transition">
                    <i class="fas fa-shopping-cart w-5"></i> Pesanan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center shadow-sm">
                <h2 class="text-xl font-bold text-slate-800">Dashboard</h2>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-800">Admin SIPKKC</p>
                            <p class="text-[10px] text-blue-600 font-bold uppercase">Super Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-slate-200 rounded-full flex items-center justify-center text-slate-500 font-bold">AS</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-slate-400 hover:text-red-500 transition"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
            </header>

            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>