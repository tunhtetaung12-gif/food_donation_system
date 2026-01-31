<aside class="w-64 bg-slate-900 h-screen flex flex-col shadow-xl">
    <div class="p-6">
        <div class="flex items-center space-x-3">
            <x-application-logo class="w-10 h-10 fill-current text-green-400" />

            <span class="text-xl font-serif font-bold tracking-wider text-white">FoodShare</span>
        </div>

        <p class="text-xs text-slate-300 mt-1 uppercase tracking-widest font-semibold">Administrator</p>
    </div>

    <nav class="flex-1 p-4 space-y-2 mt-4">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-lg">📊</span>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('admin.donations.index') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition {{ request()->routeIs('admin.donations.index') ? 'bg-green-600 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <span class="text-lg">📦</span>
            <span class="font-medium">Manage Donation</span>
        </a>
    </nav>

    <div class="p-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center space-x-3 p-3 text-slate-400 hover:text-red-400 transition">
                <span class="text-lg">🚪</span>
                <span class="font-medium">Sign Out</span>
            </button>
        </form>
    </div>
</aside>
