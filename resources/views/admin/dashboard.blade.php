<x-app-layout>
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <x-application-logo class="w-10 h-10 fill-current text-green-400" />
                    <span class="text-xl font-serif font-bold tracking-wider">FoodShare</span>
                </div>
                <p class="text-xs text-slate-400 mt-1 uppercase tracking-widest">Administrator</p>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 bg-green-600 text-white p-3 rounded-lg transition">
                    <span class="text-lg">📊</span>
                    <span class="font-medium">Overview</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 text-slate-300 hover:bg-slate-800 p-3 rounded-lg transition">
                    <span class="text-lg">👥</span>
                    <span>Manage Users</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 text-slate-300 hover:bg-slate-800 p-3 rounded-lg transition border-t border-slate-800 pt-4">
                    <span class="text-lg">⚙️</span>
                    <span>System Settings</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center space-x-3 text-red-400 hover:text-red-300 transition w-full p-2">
                        <span>🚪</span>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto">
            <header
                class="bg-white shadow-sm border-b border-gray-200 py-4 px-8 flex justify-between items-center sticky top-0 z-10">
                <h2 class="text-xl font-bold text-gray-800 italic">System Overview</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ now()->format('D, M d, Y') }}</span>
                    <div
                        class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold uppercase">
                        {{ auth()->user()->name[0] }}
                    </div>
                </div>
            </header>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-tighter">Total Members</p>
                        <p class="text-3xl font-bold mt-1">{{ $totalUsers }}</p>
                        <span class="text-xs text-green-600 font-bold italic">Live Data</span>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Recent Registrations</h3>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Latest 5</span>
                    </div>
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-400 uppercase text-xs">
                            <tr>
                                <th class="p-4 font-semibold">User</th>
                                <th class="p-4 font-semibold">Email</th>
                                <th class="p-4 font-semibold">Role</th>
                                <th class="p-4 font-semibold text-right">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($recentUsers as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ $user->email }}</td>
                                    <td class="p-4 text-sm">
                                        @php $role = $user->getRoleNames()->first(); @endphp
                                        <span
                                            class="px-2 py-1 rounded-md text-xs font-bold uppercase
                                            {{ $role == 'donor' ? 'bg-green-100 text-green-700' : ($role == 'volunteer' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                            {{ $role ?? 'No Role' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-gray-500 text-right">
                                        {{ $user->created_at->format('M d') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
