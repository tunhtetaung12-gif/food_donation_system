<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="relative overflow-hidden bg-green-600 rounded-3xl shadow-lg p-8 mb-8 text-white">
                <div class="relative z-10 flex items-center space-x-6">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                            class="h-20 w-20 rounded-full border-4 border-green-400 shadow-sm">
                    @else
                        <div
                            class="h-20 w-20 bg-white text-green-600 rounded-full flex items-center justify-center text-3xl font-bold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <h3 class="text-3xl font-bold italic">Welcome {{ Auth::user()->name }}!</h3>
                        <p class="mt-2 opacity-90 text-lg">
                            Status: <span class="capitalize font-semibold underline decoration-yellow-400">
                                {{ Auth::user()->getRoleNames()->first() ?? 'Member' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-green-500 rounded-full opacity-50"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-yellow-400 rounded-full opacity-20">
                </div>
            </div>

            @role('admin')
                <div
                    class="mb-8 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">🛡️</span>
                        <p class="font-bold text-sm">Administrator Access Active. You have full system control.</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-4 py-1 bg-red-600 text-white text-xs font-bold rounded-lg hover:bg-red-700 transition">Go
                        to Admin Panel</a>
                </div>
            @endrole

            @role('volunteer')
                <div class="mb-10 bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="bg-slate-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-900 tracking-tight">Assigned Logistics Overview
                                </h3>
                                <p class="text-xs text-gray-500">Authorized pickup list and donor coordination</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            <span class="text-[11px] font-semibold text-gray-600 uppercase tracking-widest">Live
                                Schedule</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                                        Donor Entity</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                                        Logistics Hub / Location</th>
                                    <th
                                        class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">
                                        Coordination</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($assignedDonors ?? [] as $donor)
                                    <tr class="hover:bg-gray-50/80 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-semibold text-gray-900">{{ $donor->name }}</span>
                                                <span class="text-xs text-gray-400 font-mono">{{ $donor->email }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-gray-300" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span class="text-gray-500">Pending verified address details</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="mailto:{{ $donor->email }}"
                                                class="inline-flex items-center px-4 py-2 border border-gray-200 bg-white text-gray-700 text-xs font-bold rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all uppercase tracking-tighter">
                                                <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                Initialize Contact
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="inline-flex flex-col items-center">
                                                <svg class="w-10 h-10 text-gray-200 mb-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                                <p class="text-sm font-medium text-gray-400 italic">Deployment pending: No
                                                    assignments found for current ID.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endrole

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

                @hasanyrole('donor|admin')
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-green-500 hover:shadow-md transition flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-3xl mb-4">🍎
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">My Donations</h4>
                        <p class="text-gray-500 text-sm mb-4">You have shared 0 items so far.</p>
                        <a href="#" class="mt-auto text-green-600 font-bold hover:underline">View History →</a>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-orange-500 hover:shadow-md transition flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center text-3xl mb-4">➕
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Donate Food</h4>
                        <p class="text-gray-500 text-sm mb-4">Help reduce waste today.</p>

                        <a href="{{ route('donations.create') }}"
                            class="mt-auto px-6 py-2 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition shadow-md shadow-orange-200">
                            Donate Food Now
                        </a>
                    </div>
                @endhasanyrole

                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-blue-500 hover:shadow-md transition flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-3xl mb-4">⚙️
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">Settings</h4>
                    <p class="text-gray-500 text-sm mb-4">Update your profile and avatar.</p>
                    <a href="{{ route('profile.edit') }}"
                        class="mt-auto text-blue-600 font-bold hover:underline">Edit
                        Profile →</a>
                </div>
            </div>

            <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="mr-2">🖼️</span> Community Impact Gallery
            </h4>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                <div class="group relative h-48 bg-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=400"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-3">
                        <p class="text-white text-xs font-semibold">Local Food Bank Delivery</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                    <span class="mr-2 text-xl">🔔</span> Recent Notifications
                </h4>
                <div class="space-y-3">
                    <div class="flex items-start p-4 bg-green-50 rounded-xl border-l-4 border-green-500">
                        <span class="mr-3 text-xl">🎉</span>
                        <div>
                            <p class="text-sm font-bold text-green-900">Welcome to FoodShare!</p>
                            <p class="text-xs text-green-700">Thank you for joining as a
                                {{ Auth::user()->getRoleNames()->first() }}.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
