<x-app-layout>
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed top-6 right-6 z-[100] max-w-sm w-full px-4">
            <div
                class="bg-white/90 backdrop-blur-md border border-green-100 shadow-2xl rounded-2xl p-4 flex items-center space-x-4">
                <div class="bg-green-500 p-2 rounded-full flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-800">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Donor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="relative overflow-hidden bg-gradient-to-br from-green-600 to-green-700 rounded-[2rem] shadow-xl p-8 mb-10 text-white">
                <div class="relative z-10 flex flex-col md:flex-row items-center md:space-x-8">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                            class="h-28 w-28 rounded-3xl border-4 border-white/20 shadow-lg object-cover">
                    @else
                        <div
                            class="h-28 w-28 bg-white text-green-600 rounded-3xl flex items-center justify-center text-4xl font-black shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="mt-6 md:mt-0 text-center md:text-left">
                        <h3 class="text-4xl font-extrabold tracking-tight">Welcome, {{ Auth::user()->name }}!</h3>
                        <p class="mt-2 text-green-100 text-lg font-medium">
                            Account Type: <span
                                class="px-3 py-1 bg-white/20 rounded-full text-sm uppercase tracking-wider ml-2">
                                {{ Auth::user()->getRoleNames()->first() ?? 'Member' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-yellow-400/20 rounded-full blur-2xl">
                </div>
            </div>

            @role('admin')
                <div
                    class="mb-8 p-5 bg-white border border-red-100 rounded-2xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center">
                        <div class="bg-red-100 p-3 rounded-xl mr-4 text-2xl">🛡️</div>
                        <div>
                            <p class="font-bold text-gray-900">Administrator Access Active</p>
                            <p class="text-sm text-gray-500">You have full system control and management permissions.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}"
                        class="w-full md:w-auto px-6 py-2.5 bg-red-600 text-white text-sm font-bold rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-200 text-center">
                        Admin Panel
                    </a>
                </div>
            @endrole

            @role('volunteer')
                <div class="mb-10 bg-white shadow-sm border border-gray-100 rounded-[2rem] overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg shadow-blue-100">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Your Assigned Pickups</h3>
                                <p class="text-sm text-gray-500 font-medium">Coordinate and track active collections</p>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Food &
                                        Donor</th>
                                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
                                        Logistics</th>
                                    <th
                                        class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($assignedDonations as $donation)
                                    <tr class="hover:bg-blue-50/30 transition-colors">
                                        <td class="px-8 py-6">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-lg font-bold text-gray-900">{{ $donation->food_name }}</span>
                                                <span
                                                    class="inline-flex items-center text-sm font-bold text-green-600 mt-1">
                                                    📦 {{ $donation->quantity }}
                                                </span>
                                                <span class="text-xs text-gray-400 mt-1 font-medium italic">Donor:
                                                    {{ $donation->user->name ?? 'Guest Donor' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="space-y-2 text-sm">
                                                <div class="flex items-center text-gray-600">
                                                    <span class="w-5 text-lg">📍</span> <span
                                                        class="font-medium ml-1">{{ $donation->pickup_location }}</span>
                                                </div>
                                                <div class="flex items-center text-gray-500">
                                                    <span class="w-5 text-lg">🏁</span> <span
                                                        class="ml-1">{{ $donation->place }}</span>
                                                </div>
                                                <div
                                                    class="flex items-center {{ $donation->expiry_date && $donation->expiry_date->isPast() ? 'text-red-600' : 'text-orange-600' }}">
                                                    <span class="w-5 text-lg">🕒</span>
                                                    <span class="font-bold ml-1">Expires:
                                                        {{ $donation->expiry_date ? $donation->expiry_date->format('M d, h:i A') : 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <div class="flex flex-col items-end space-y-3">
                                                <button type="button"
                                                    onclick="openDonorModal({{ json_encode($donation->user) }})"
                                                    class="inline-flex items-center px-5 py-2.5 bg-blue-50 text-blue-700 text-xs font-black rounded-xl hover:bg-blue-100 transition-all uppercase tracking-tighter w-max border border-blue-100">
                                                    Contact Donor
                                                </button>

                                                <form action="{{ route('volunteer.donations.complete', $donation->id) }}"
                                                    method="POST" id="complete-form-{{ $donation->id }}">
                                                    @csrf
                                                    <button type="button"
                                                        onclick="confirmPickup('{{ $donation->id }}', '{{ $donation->food_name }}')"
                                                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-tighter transition-all shadow-lg shadow-green-100 active:scale-95">
                                                        Mark Picked Up
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-8 py-20 text-center">
                                            <div class="text-4xl mb-4">✨</div>
                                            <p class="text-gray-400 font-medium italic">No active assignments. You're all
                                                caught up!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endrole

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                @hasanyrole('donor')
                    <div
                        class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all group">
                        <div
                            class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition">
                            🍎</div>
                        <h4 class="text-xl font-black text-gray-900 mb-2">My Donations</h4>
                        <p class="text-gray-500 font-medium mb-6">
                            You have contributed <span
                                class="text-green-600 font-bold">{{ Auth::user()->donations->count() }} items</span> to
                            the community.
                        </p>
                        <a href="{{ route('donations.index') }}"
                            class="text-green-600 font-bold flex items-center hover:underline italic">
                            History & Stats <span class="ml-2 group-hover:translate-x-2 transition">→</span>
                        </a>
                    </div>

                    <div
                        class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all group relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                            <svg class="w-24 h-24 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                        </div>
                        <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center text-3xl mb-6">➕
                        </div>
                        <h4 class="text-xl font-black text-gray-900 mb-2">Donate Food</h4>
                        <p class="text-gray-500 font-medium mb-8">Got surplus? Share it now and reduce local food waste.
                        </p>
                        <a href="{{ route('donations.create') }}"
                            class="block w-full text-center py-4 bg-orange-500 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-orange-600 transition shadow-lg shadow-orange-100">
                            Create Donation
                        </a>
                    </div>
                @endhasanyrole

                @role('member')
                    <div
                        class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all group">
                        <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center text-3xl mb-6">🤝
                        </div>
                        <h4 class="text-xl font-black text-gray-900 mb-2">Request Support</h4>
                        <p class="text-gray-500 font-medium mb-8">In need of assistance? We are here to help you get food.
                        </p>
                        <a href="{{ route('member.requests.create') }}"
                            class="block w-full text-center py-4 bg-indigo-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                            New Request
                        </a>
                    </div>
                @endrole

                <div
                    class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl mb-6">⚙️
                    </div>
                    <h4 class="text-xl font-black text-gray-900 mb-2">Account Settings</h4>
                    <p class="text-gray-500 font-medium mb-6">Manage your contact info, location, and security details.
                    </p>
                    <a href="{{ route('profile.edit') }}"
                        class="text-blue-600 font-bold flex items-center hover:underline italic">
                        Edit Profile <span class="ml-2 group-hover:translate-x-2 transition">→</span>
                    </a>
                </div>
            </div>

            @hasanyrole('donor')
                <div class="mb-12">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                        <div
                            class="px-8 py-6 border-b border-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/30">
                            <div>
                                <h3 class="text-xl font-black text-gray-900 tracking-tight">Community Needs</h3>
                                <p class="text-sm text-gray-500 font-medium italic">Verified requests from people who need
                                    your help</p>
                            </div>
                            <span
                                class="px-4 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-black rounded-full uppercase tracking-wider">
                                {{ $availableRequests->count() }} Open Requests
                            </span>
                        </div>

                        <div class="divide-y divide-gray-50">
                            @forelse($availableRequests as $request)
                                <div class="p-8 hover:bg-indigo-50/20 transition group">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                                        <div class="md:col-span-5">
                                            <div class="flex items-center mb-2">
                                                <span
                                                    class="px-2.5 py-1 text-[10px] font-black rounded-md uppercase tracking-tighter mr-3
                                                    {{ $request->urgency == 'high' ? 'bg-red-100 text-red-700' : ($request->urgency == 'medium' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700') }}">
                                                    {{ $request->urgency }} Urgency
                                                </span>
                                                <span
                                                    class="text-[10px] text-gray-400 font-mono">#{{ $request->id }}</span>
                                            </div>
                                            <h4
                                                class="text-lg font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition">
                                                {{ $request->items_needed }}</h4>
                                            @if ($request->quantities)
                                                <div class="flex items-center gap-1.5 mb-2">
                                                    <span
                                                        class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Needed:</span>
                                                    <span
                                                        class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[11px] font-bold rounded-md border border-indigo-100">
                                                        {{ $request->quantities }}
                                                    </span>
                                                </div>
                                            @endif
                                            <p class="text-sm text-gray-500 italic line-clamp-2">"{{ $request->reason }}"
                                            </p>
                                        </div>
                                        <div class="md:col-span-4">
                                            <div class="flex items-center text-sm text-gray-600 font-medium">
                                                <span class="text-lg mr-2">📍</span> {{ $request->address }}
                                            </div>
                                        </div>
                                        <div class="md:col-span-3 text-right">
                                            <a href="{{ route('donations.create', ['request_id' => $request->id]) }}"
                                                class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black rounded-xl transition-all uppercase tracking-widest shadow-lg shadow-indigo-100 active:scale-95">
                                                Help Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-8 py-20 text-center">
                                    <div class="text-4xl mb-4">🙌</div>
                                    <p class="text-gray-400 font-medium italic">No active requests. The community is doing
                                        great!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endhasanyrole

            <div class="mb-12">
                <h4 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                    <span class="mr-3">📸</span> Community Impact Gallery
                </h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="group relative h-60 bg-gray-200 rounded-[2rem] overflow-hidden shadow-sm">
                        <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=400"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6 translate-y-4 group-hover:translate-y-0 transition-transform">
                            <p class="text-white text-sm font-bold">Local Food Bank Delivery</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm p-8 border border-gray-100">
                <h4 class="font-black text-xl text-gray-900 mb-6 flex items-center">
                    <span class="mr-3 text-2xl">🔔</span> Recent Activity
                </h4>
                <div class="space-y-4">
                    <div class="flex items-start p-5 bg-green-50/50 rounded-2xl border-l-8 border-green-500">
                        <span class="mr-4 text-2xl">🎉</span>
                        <div>
                            <p class="font-black text-green-900">Welcome to FoodShare!</p>
                            <p class="text-sm text-green-700 font-medium">Thank you for joining as a
                                {{ Auth::user()->getRoleNames()->first() }}. Let's make a difference.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<div id="donorModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-md transition-opacity" onclick="closeDonorModal()"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            class="relative transform overflow-hidden rounded-[2.5rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
            <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700 relative">
                <button onclick="closeDonorModal()"
                    class="absolute top-6 right-6 text-white/60 hover:text-white transition-colors bg-white/10 p-2 rounded-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <div class="px-8 pb-10">
                <div class="relative -mt-16 mb-6 flex justify-center">
                    <img id="modal-photo" src=""
                        class="w-32 h-32 rounded-[2rem] object-cover border-8 border-white shadow-2xl bg-gray-100">
                </div>

                <div class="text-center mb-10">
                    <h3 id="modal-name" class="text-3xl font-black text-gray-900 tracking-tight">Donor Name</h3>
                    <p
                        class="mt-1 inline-block px-4 py-1 bg-blue-50 text-[10px] font-black text-blue-600 uppercase tracking-[0.2em] rounded-full">
                        Verified Community Donor
                    </p>
                </div>

                <div class="space-y-4">
                    <div
                        class="group flex items-center p-5 bg-gray-50 rounded-3xl border border-transparent hover:border-blue-100 hover:bg-blue-50/50 transition-all">
                        <div class="bg-white p-3 rounded-2xl shadow-sm mr-5 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    stroke-width="2" />
                            </svg>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest">Email Address</p>
                            <a id="modal-email" href=""
                                class="text-base font-bold text-gray-800 hover:text-blue-600 transition-colors truncate block"></a>
                        </div>
                    </div>

                    <div
                        class="group flex items-center p-5 bg-gray-50 rounded-3xl border border-transparent hover:border-green-100 hover:bg-green-50/50 transition-all">
                        <div class="bg-white p-3 rounded-2xl shadow-sm mr-5 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                    stroke-width="2" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] uppercase font-black text-gray-400 tracking-widest">Phone Number</p>
                            <p id="modal-phone" class="text-base font-bold text-gray-800"></p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-4">
                    <a id="modal-call-btn" href=""
                        class="flex items-center justify-center bg-gray-900 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-black transition-all active:scale-95 shadow-xl shadow-gray-200">
                        Call Now
                    </a>
                    <a id="modal-email-btn" href=""
                        class="flex items-center justify-center bg-blue-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all active:scale-95 shadow-xl shadow-blue-200">
                        Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openDonorModal(user) {
        document.getElementById('modal-name').innerText = user.name;
        document.getElementById('modal-email').innerText = user.email;
        document.getElementById('modal-email').href = "mailto:" + user.email;
        document.getElementById('modal-phone').innerText = user.phone ? user.phone : 'Not Provided';

        document.getElementById('modal-email-btn').href = "mailto:" + user.email;
        document.getElementById('modal-call-btn').href = user.phone ? "tel:" + user.phone : "#";

        if (!user.phone) {
            document.getElementById('modal-call-btn').classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            document.getElementById('modal-call-btn').classList.remove('opacity-50', 'cursor-not-allowed');
        }

        const photoPath = user.profile_photo ?
            "/storage/" + user.profile_photo :
            "https://ui-avatars.com/api/?name=" + encodeURIComponent(user.name) +
            "&background=2563eb&color=fff&size=128";
        document.getElementById('modal-photo').src = photoPath;

        const modal = document.getElementById('donorModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDonorModal() {
        const modal = document.getElementById('donorModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function confirmPickup(id, foodName) {
        Swal.fire({
            title: 'Confirm Collection',
            text: `Did you pick up the ${foodName}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Yes, Collected!',
            cancelButtonText: 'Not yet',
            customClass: {
                popup: 'rounded-[2rem] p-8',
                confirmButton: 'rounded-2xl px-8 py-3 font-bold uppercase tracking-widest text-xs',
                cancelButton: 'rounded-2xl px-8 py-3 font-bold uppercase tracking-widest text-xs'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('complete-form-' + id).submit();
            }
        });
    }
</script>
