<x-app-layout>
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        @include('layouts.admin-sidebar')

        <main class="flex-1 overflow-y-auto p-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-800">Donation Logistics</h2>
                    <p class="text-sm text-gray-500 mt-1">Total Active Donations: {{ $donations->count() }}</p>
                </div>

                @if (session('success'))
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-lg text-sm animate-bounce">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="p-4 font-bold">Food Item & Donor</th>
                            <th class="p-4 font-bold">Donation Description</th>
                            <th class="p-4 font-bold">Pickup Location</th>
                            <th class="p-4 font-bold">Donation Location</th>
                            <th class="p-4 font-bold">Donation Date</th>
                            <th class="p-4 font-bold">Assign Volunteer</th>
                            <th class="p-4 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($donations as $donation)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $donation->food_name }}</div>
                                    <div class="text-xs text-gray-500">From:
                                        {{ $donation->user->name ?? 'Guest Donor' }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-xs text-gray-600 italic leading-snug max-w-[180px]"
                                        title="{{ $donation->description }}">
                                        @if ($donation->description)
                                            "{{ Str::limit($donation->description, 45) }}"
                                        @else
                                            <span class="text-gray-300">No description provided</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-xs text-gray-600 leading-relaxed">
                                    {{ $donation->pickup_location }}
                                </td>
                                <td class="p-4 text-xs text-gray-600 leading-relaxed">
                                    {{ $donation->place }}
                                </td>


                                <td class="p-4 text-xs font-medium">
                                    {{ $donation->expiry_date->format('M d, h:i A') }}
                                </td>

                                {{-- <td class="p-4">
                                    <form action="{{ route('admin.donations.assign', $donation->id) }}" method="POST"
                                        class="flex items-center space-x-2">
                                        @csrf
                                        <select name="volunteer_id"
                                            class="text-xs border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500 py-1 bg-gray-50">
                                            <option>Select Volunteer...</option>
                                            @foreach ($volunteers as $volunteer)
                                                <option value="{{ $volunteer->id }}"
                                                    {{ $volunteer->id == $donation->volunteer_id ? 'selected' : '' }}>
                                                    {{ $volunteer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                </td> --}}
                                <td class="p-4 text-right">
                                    <form action="{{ route('admin.donations.assign', $donation->id) }}" method="POST"
                                        class="flex items-center justify-end space-x-2">
                                        @csrf
                                        {{-- @method('POST') --}}
                                        <select name="volunteer_id" onchange="this.form.submit()"
                                            class="text-xs border-gray-200 rounded-lg focus:ring-slate-900 focus:border-slate-900 py-1 bg-gray-50 transition-all hover:border-gray-400">
                                            <option value="">Select Volunteer...</option>
                                            @foreach ($volunteers as $volunteer)
                                                <option value="{{ $volunteer->id }}"
                                                    {{ $volunteer->id == $donation->volunteer_id ? 'selected' : '' }}>
                                                    {{ $volunteer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex items-center">
                                        <span
                                            class="font-bold {{ $donation->volunteer_id ? 'text-green-600' : 'text-orange-500' }}">
                                            <span class="mr-1">●</span>
                                            {{ $donation->volunteer_id ? 'Assigned' : 'Pending' }}
                                        </span>
                                    </div>
                                </td>
                                {{-- <td class="p-4">
                                    <span
                                        class="px-2 py-1 text-[9px] font-black rounded uppercase tracking-tighter {{ $donation->volunteer_id ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                        {{ $donation->volunteer_id ? 'Assigned' : 'Pending' }}
                                    </span>
                                </td> --}}
                                {{-- <td class="p-4 text-right">
                                    <button type="submit"
                                        class="bg-slate-900 hover:bg-black text-white text-[10px] font-bold px-4 py-2 rounded transition shadow-sm uppercase">
                                        Assign
                                    </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400 italic text-sm">
                                    No donation items currently require logistics management.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>
