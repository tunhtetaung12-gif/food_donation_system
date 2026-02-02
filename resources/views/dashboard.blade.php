<x-app-layout>
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed top-6 right-6 z-[100] max-w-sm w-full">

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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="relative overflow-hidden bg-green-600 rounded-3xl shadow-lg p-8 mb-8 text-white">
                <div class="relative z-10 flex items-center space-x-6">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
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
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-900 tracking-tight">Your Assigned Pickups</h3>
                                <p class="text-xs text-gray-500">Coordinate with donors to collect surplus food</p>
                            </div>
                        </div>
                    </div>



                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Food
                                        Item & Donor</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                                        Pickup Details</th>
                                    <th
                                        class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">
                                        Coordination</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($assignedDonations as $donation)
                                    <tr class="hover:bg-gray-50/80 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-bold text-gray-900">{{ $donation->food_name }}</span>
                                                <span
                                                    class="text-xs text-green-600 font-semibold">{{ $donation->quantity }}</span>
                                                <span class="text-[10px] text-gray-400">Donor:
                                                    {{ $donation->user->name ?? 'Guest Donor' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col text-xs text-gray-600">
                                                <div class="flex items-center mb-1">
                                                    <span class="font-bold mr-1">📍 Pickup:</span>
                                                    {{ $donation->pickup_location }}
                                                </div>
                                                <div class="flex items-center mb-1">
                                                    <span class="font-bold mr-1">📍 Drop-off:</span> {{ $donation->place }}
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="font-bold mr-1">🕒 Expiry:</span>
                                                    <span
                                                        class="{{ $donation->expiry_date && $donation->expiry_date->isPast() ? 'text-red-500 font-bold' : '' }}">
                                                        {{ $donation->expiry_date ? $donation->expiry_date->format('M d, h:i A') : 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex flex-col items-end space-y-2">
                                                <button type="button"
                                                    onclick="openDonorModal({{ json_encode($donation->user) }})"
                                                    class="inline-flex items-center px-4 py-2 border border-blue-200 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-lg hover:bg-blue-100 transition-all uppercase w-max">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    Contact Donor
                                                </button>

                                                <form action="{{ route('volunteer.donations.complete', $donation->id) }}"
                                                    method="POST" id="complete-form-{{ $donation->id }}">
                                                    @csrf
                                                    <button type="button"
                                                        onclick="confirmPickup('{{ $donation->id }}', '{{ $donation->food_name }}')"
                                                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-[10px] font-bold uppercase transition-all shadow-sm active:scale-95">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Mark Picked Up
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <p class="text-sm font-medium text-gray-400 italic">No assignments found. Check
                                                back later!</p>
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


<div id="donorModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="closeDonorModal()"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
            <div class="h-24 bg-gradient-to-r from-blue-600 to-indigo-700">
                <button onclick="closeDonorModal()"
                    class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <div class="px-6 pb-8">
                <div class="relative -mt-12 mb-4 flex justify-center">
                    <img id="modal-photo" src=""
                        class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-xl bg-white">
                </div>

                <div class="text-center mb-8">
                    <h3 id="modal-name" class="text-2xl font-black text-gray-900 tracking-tight">Donor Name</h3>
                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em]">Verified FoodShare Donor
                    </p>
                </div>

                <div class="space-y-3">
                    <div
                        class="group flex items-center p-4 bg-gray-50 rounded-2xl border border-transparent hover:border-blue-100 hover:bg-blue-50/30 transition-all">
                        <div class="bg-white p-2.5 rounded-xl shadow-sm mr-4 text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    stroke-width="2" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase font-black text-gray-400 tracking-widest">Email Address</p>
                            <a id="modal-email" href=""
                                class="text-sm font-bold text-gray-700 hover:text-blue-600 transition-colors"></a>
                        </div>
                    </div>

                    <div
                        class="group flex items-center p-4 bg-gray-50 rounded-2xl border border-transparent hover:border-green-100 hover:bg-green-50/30 transition-all">
                        <div class="bg-white p-2.5 rounded-xl shadow-sm mr-4 text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                    stroke-width="2" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase font-black text-gray-400 tracking-widest">Phone Number</p>
                            <p id="modal-phone" class="text-sm font-bold text-gray-700"></p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-2 gap-3">
                    <a id="modal-call-btn" href=""
                        class="flex items-center justify-center bg-gray-900 text-white py-3.5 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-black transition-all active:scale-95">
                        Call Now
                    </a>
                    <a id="modal-email-btn" href=""
                        class="flex items-center justify-center bg-blue-600 text-white py-3.5 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-blue-700 transition-all active:scale-95">
                        Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

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
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-6 py-3',
                cancelButton: 'rounded-xl px-6 py-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('complete-form-' + id).submit();
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
