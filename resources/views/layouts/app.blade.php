<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Kos Ginting - Sistem Manajemen</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        <!-- Icons (Font Awesome) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
        body {
                font-family: 'Plus Jakarta Sans', sans-serif;
        }
        </style>
</head>
<body class="antialiased bg-[#F8FAFC] text-slate-900">
        <div class="min-h-screen">
        <!-- Navbar Melayang (Sticky) -->
        <div class="sticky top-0 z-50">
                @include('layouts.navigation')
        </div>

        
        @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-slate-100">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-4">
                        <div class="h-8 w-1.5 bg-indigo-600 rounded-full"></div>
                        <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight">
                                {{ $header }}
                        </h2>
                        </div>
                </div>
                </header>
        @endisset

        <!-- Page Content -->
        <main class="py-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
                </div>
        </main>
        </div>

        <!-- Footer Simpel -->
        <footer class="py-10 text-center">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                &copy; 2026 Kos Ginting • 
        </p>
        </footer>
</body>
</html>