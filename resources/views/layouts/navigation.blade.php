<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    {{-- Link Logo dinamis berdasarkan Role --}}
                    @php
                        $dashboardRoute = route('penyewa.welcome');
                        if(Auth::user()->role == 'admin') $dashboardRoute = route('admin.dashboard');
                        if(Auth::user()->role == 'manager') $dashboardRoute = route('manager.dashboard');
                    @endphp
                    
                    <a href="{{ $dashboardRoute }}" class="flex items-center gap-3 group">
                        <div class="bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-200 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-house-chimney text-white text-xl"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-black text-slate-900 leading-none tracking-tight text-lg uppercase">Kos Ginting</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">Sistem Manajemen</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-12 sm:flex">
                    @if(Auth::user()->role == 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('DASHBOARD') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.kamar.index')" :active="request()->routeIs('admin.kamar.*')">
                            {{ __('MANAJEMEN KAMAR') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.booking.index')" :active="request()->routeIs('admin.booking.*')">
                            {{ __('PESANAN') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.catering.index')" :active="request()->routeIs('admin.catering.*')">
                            {{ __('CATERING') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="route('admin.ulasan.index')" :active="request()->routeIs('admin.ulasan.*')">
                            {{ __('ULASAN') }}
                        </x-nav-link>

                    @elseif(Auth::user()->role == 'manager')
                        <x-nav-link :href="route('manager.dashboard')" :active="request()->routeIs('manager.dashboard')">
                            {{ __('LAPORAN EKSEKUTIF') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="route('manager.ulasan.index')" :active="request()->routeIs('manager.ulasan.*')">
                            {{ __('ULASAN PENYEWA') }}
                        </x-nav-link>

                    @elseif(Auth::user()->role == 'penyewa')
                        <x-nav-link :href="route('penyewa.welcome')" :active="request()->routeIs('penyewa.welcome')">
                            {{ __('KATALOG KAMAR') }}
                        </x-nav-link>

                        <x-nav-link :href="route('penyewa.riwayat')" :active="request()->routeIs('penyewa.riwayat')">
                            {{ __('RIWAYAT SAYA') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="route('penyewa.ulasan.create')" :active="request()->routeIs('penyewa.ulasan.*')">
                            {{ __('ULASAN KAMAR') }}
                        </x-nav-link>
                        
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                <div class="flex items-center gap-4 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100">
                    <div class="text-right">
                        <p class="text-xs font-black text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-tighter mt-1">
                            @if(Auth::user()->role == 'admin')
                                SUPER ADMIN
                            @elseif(Auth::user()->role == 'manager')
                                MANAGER KOS
                            @else
                                PENYEWA
                            @endif
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors flex items-center">
                            <i class="fa-solid fa-right-from-bracket text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-100">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role == 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.kamar.index')" :active="request()->routeIs('admin.kamar.*')">Manajemen Kamar</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.booking.index')" :active="request()->routeIs('admin.booking.*')">Pesanan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.catering.index')" :active="request()->routeIs('admin.catering.*')">Catering</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.ulasan.index')" :active="request()->routeIs('admin.ulasan.*')">Ulasan</x-responsive-nav-link>
            
            @elseif(Auth::user()->role == 'manager')
                <x-responsive-nav-link :href="route('manager.dashboard')" :active="request()->routeIs('manager.dashboard')">Laporan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('manager.ulasan.index')" :active="request()->routeIs('manager.ulasan.*')">Ulasan Penyewa</x-responsive-nav-link>
            
            @else
                <x-responsive-nav-link :href="route('penyewa.welcome')" :active="request()->routeIs('penyewa.welcome')">Katalog</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('penyewa.riwayat')" :active="request()->routeIs('penyewa.riwayat')">Riwayat</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('penyewa.ulasan.create')" :active="request()->routeIs('penyewa.ulasan.*')">Ulasan Kamar</x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>