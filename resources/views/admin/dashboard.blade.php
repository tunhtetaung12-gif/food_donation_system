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
                    class="flex items-center space-x-3 bg-green-600 text-white p-3 rounded-lg transition shadow-lg shadow-green-900/20">
                    <span class="text-lg">📊</span>
                    <span class="font-medium">Overview</span>
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center space-x-3 {{ request()->routeIs('admin.users.index') ? 'bg-green-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} p-3 rounded-lg transition">
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
                    @if (session('status'))
                        <span class="text-sm font-bold text-green-600 animate-pulse">{{ session('status') }}</span>
                    @endif
                    <span class="text-sm text-gray-500">{{ now()->format('D, M d, Y') }}</span>
                    <div
                        class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold uppercase border border-green-200">
                        {{ auth()->user()->name[0] }}
                    </div>
                </div>
            </header>

            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-t-4 border-t-slate-900">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Total Members</p>
                        <p class="text-3xl font-bold mt-1 text-gray-900">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-t-4 border-t-green-500">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Donors</p>
                        <p class="text-3xl font-bold mt-1 text-green-600">{{ $donorCount ?? 0 }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-t-4 border-t-blue-500">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Volunteers</p>
                        <p class="text-3xl font-bold mt-1 text-blue-600">{{ $volunteerCount ?? 0 }}</p>
                    </div>
                    {{-- <div
                        class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-t-4 border-t-yellow-500">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">System Health</p>
                        <p class="text-3xl font-bold mt-1 text-yellow-600 text-sm">Optimal</p>
                    </div> --}}
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <h3 class="font-bold text-gray-800 font-serif text-lg">Donor & Volunteer Matching</h3>
                            <p class="text-xs text-gray-500 italic">Assign registered volunteers to donors for
                                logistics.</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50 text-gray-400 uppercase text-xs">
                                <tr>
                                    <th class="p-4 font-semibold">Donor Name</th>
                                    <th class="p-4 font-semibold">Email</th>
                                    <th class="p-4 font-semibold">Assign Volunteer</th>
                                    <th class="p-4 font-semibold">Status</th>
                                    <th class="p-4 font-semibold text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($donors as $donor)
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="p-4 text-sm font-medium text-gray-900">{{ $donor->name }}</td>
                                        <td class="p-4 text-sm text-gray-600">{{ $donor->email }}</td>
                                        <td class="p-4 text-sm">
                                            <form action="{{ route('admin.assign') }}" method="POST"
                                                class="flex items-center space-x-2">
                                                @csrf
                                                <input type="hidden" name="donor_id" value="{{ $donor->id }}">
                                                <select name="volunteer_id"
                                                    class="text-xs border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500 py-1 bg-gray-50">
                                                    <option value="">Select Volunteer...</option>
                                                    @foreach ($volunteers as $volunteer)
                                                        <option value="{{ $volunteer->id }}"
                                                            {{ $donor->assigned_to == $volunteer->id ? 'selected' : '' }}>
                                                            {{ $volunteer->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        </td>
                                        <td class="p-4">
                                            @if ($donor->assigned_to)
                                                <span
                                                    class="px-2 py-1 text-[10px] font-black rounded bg-green-100 text-green-700 uppercase tracking-tighter">Assigned</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-[10px] font-black rounded bg-yellow-100 text-yellow-700 uppercase tracking-tighter">Pending</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right">
                                            <button type="submit"
                                                class="bg-slate-900 hover:bg-black text-white text-[10px] font-bold px-3 py-1.5 rounded shadow-sm transition uppercase">
                                                Update
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center text-gray-500 text-sm">No donors
                                            found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Recent Activity</h3>
                        <span
                            class="text-[10px] font-bold bg-gray-100 text-gray-500 px-2 py-1 rounded uppercase tracking-widest">Audit
                            Log</span>
                    </div>
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-400 uppercase text-xs">
                            <tr>
                                <th class="p-4 font-semibold">User</th>
                                <th class="p-4 font-semibold">Role</th>
                                <th class="p-4 font-semibold text-right">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($recentUsers as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="p-4 text-sm">
                                        @php $role = $user->getRoleNames()->first(); @endphp
                                        <span
                                            class="px-2 py-1 rounded-md text-[10px] font-bold uppercase
                                            {{ $role == 'donor' ? 'bg-green-100 text-green-700' : ($role == 'volunteer' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                            {{ $role ?? 'Member' }}
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
