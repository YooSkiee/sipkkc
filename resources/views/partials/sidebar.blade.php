<aside class="fixed left-0 top-0 w-64 h-screen bg-indigo-900 text-white shadow-lg">

    <div class="p-6 text-xl font-bold border-b border-indigo-700">
        🏢 Kos Ginting
    </div>

    <nav class="mt-4 space-y-1 px-3">

        <a href="{{ route('admin.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-indigo-700">
            📊 Dashboard
        </a>

        <a href="{{ route('admin.kamar.index') }}"
           class="block px-4 py-2 rounded hover:bg-indigo-700">
            🛏️ Kamar
        </a>

        <a href="{{ route('admin.catering.index') }}"
           class="block px-4 py-2 rounded hover:bg-indigo-700">
            🍽️ Catering
        </a>

    </nav>

</aside>