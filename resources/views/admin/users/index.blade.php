<x-app-layout>
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <x-application-logo class="w-10 h-10 fill-current text-green-400" />
                    <span class="text-xl font-serif font-bold tracking-wider">FoodShare</span>
                </div>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 text-slate-300 hover:bg-slate-800 p-3 rounded-lg transition">
                    <span>📊</span><span>Overview</span>
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center space-x-3 bg-green-600 text-white p-3 rounded-lg transition shadow-md">
                    <span>👥</span><span class="font-medium">Manage Users</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto">
            <header
                class="bg-white border-b border-gray-200 py-4 px-8 flex justify-between items-center sticky top-0 z-10">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-900">User Directory</h2>
                    <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold mt-1">Manage platform access
                        and roles</p>
                </div>
                <div class="flex items-center space-x-4">
                    @if (session('status'))
                        <span class="text-sm text-green-600 font-bold animate-fade">✨ {{ session('status') }}</span>
                    @endif
                </div>
            </header>

            <div class="p-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Member
                                    Details</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Access
                                    Level</th>
                                <th
                                    class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500 text-right">
                                    Operations</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50/50 transition duration-150">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold mr-3 border border-slate-200">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php $role = $user->getRoleNames()->first(); @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-tight
                                            {{ $role == 'admin'
                                                ? 'bg-rose-100 text-rose-700'
                                                : ($role == 'donor'
                                                    ? 'bg-emerald-100 text-emerald-700'
                                                    : 'bg-sky-100 text-sky-700') }}">
                                            <span
                                                class="w-1 h-1 rounded-full mr-1.5 {{ $role == 'admin' ? 'bg-rose-500' : ($role == 'donor' ? 'bg-emerald-500' : 'bg-sky-500') }}"></span>
                                            {{ $role ?? 'Member' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-4">
                                            <a href="{{ route('admin.users.show', $user) }}"
                                                class="inline-flex items-center px-4 py-1.5 bg-slate-50 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-full hover:bg-slate-600 hover:text-white transition-all duration-300 ease-in-out shadow-sm hover:shadow-md border border-slate-100">
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-widest rounded-full hover:bg-indigo-600 hover:text-white transition-all duration-300 ease-in-out shadow-sm hover:shadow-md">
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to remove this member?');"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-1.5 bg-rose-50 text-rose-700 text-[10px] font-black uppercase tracking-widest rounded-full hover:bg-rose-600 hover:text-white transition-all duration-300 ease-in-out shadow-sm hover:shadow-md border border-rose-100">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
