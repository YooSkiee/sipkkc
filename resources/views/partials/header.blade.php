<header class="h-16 bg-white border-b flex items-center justify-between px-6 shadow-sm">

    {{-- LEFT --}}
    <div>
        <h1 class="text-lg font-semibold text-gray-800">
            @yield('title', 'Dashboard')
        </h1>
    </div>

    {{-- RIGHT --}}
    <div class="flex items-center gap-4">

        {{-- Search --}}
        <input type="text" placeholder="Search..."
            class="border px-3 py-1 rounded text-sm focus:ring focus:ring-indigo-200">

        {{-- Notif --}}
        <div class="relative">
            <span class="text-xl cursor-pointer">🔔</span>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">3</span>
        </div>

        {{-- User --}}
        <div class="flex items-center gap-2">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                 class="w-8 h-8 rounded-full">
            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-red-500 ml-2">Logout</button>
            </form>
        </div>

    </div>

</header>