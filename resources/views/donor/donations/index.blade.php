<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-serif font-bold text-slate-900">Donation Records</h2>
                    <p class="text-sm text-slate-500 mt-1 uppercase tracking-widest font-semibold">Personal Contribution
                        Archive</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Total Entries</span>
                    <p class="text-2xl font-mono font-bold text-slate-800">{{ $donations->total() }}</p>
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-xl shadow-slate-200/50 rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-900 text-slate-300 uppercase text-[10px] tracking-[0.15em]">
                        <tr>
                            <th class="p-5 font-bold border-b border-slate-800">Food Item & Donor</th>
                            <th class="p-5 font-bold border-b border-slate-800">Donation Description</th>
                            <th class="p-5 font-bold border-b border-slate-800">Pickup Location</th>
                            <th class="p-5 font-bold border-b border-slate-800">Donation Location</th>
                            <th class="p-5 font-bold border-b border-slate-800">Donation Date</th>
                            <th class="p-5 font-bold border-b border-slate-800">Status</th>
                            <th class="p-5 font-bold border-b border-slate-800 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($donations as $donation)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="p-5">
                                    <div
                                        class="text-sm font-bold text-slate-800 group-hover:text-blue-700 transition-colors">
                                        {{ $donation->food_name }}</div>
                                    {{-- <div class="text-[10px] text-slate-400 mt-1 uppercase font-medium">Ref:
                                        #DN-{{ str_pad($donation->id, 4, '0', STR_PAD_LEFT) }}</div> --}}
                                </td>

                                <td class="p-5">
                                    <div class="text-xs text-slate-600 leading-relaxed italic max-w-xs">
                                        {{ $donation->description ?: 'No additional notes provided.' }}
                                    </div>
                                </td>

                                <td class="p-5 text-xs text-slate-600 font-medium">
                                    {{ $donation->pickup_location }}
                                </td>

                                <td class="p-5 text-xs text-slate-600 font-medium">
                                    {{ $donation->place }}
                                </td>

                                <td class="p-5">
                                    <div class="text-xs font-bold text-slate-700">
                                        {{ $donation->created_at->format('d M, Y') }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase">
                                        {{ $donation->created_at->format('h:i A') }}</div>
                                </td>

                                <td class="p-5">
                                    @if ($donation->volunteer_id && $donation->volunteer)
                                        <div class="relative group inline-block">
                                            <span
                                                class="cursor-help inline-flex items-center px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider border bg-emerald-50 text-emerald-700 border-emerald-200">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full mr-1.5 bg-emerald-500 animate-pulse"></span>
                                                Assigned
                                            </span>

                                            <div
                                                class="invisible group-hover:visible absolute z-50 bottom-full left-1/2 -translate-x-1/2 mb-2 w-48 bg-slate-900 text-white rounded-lg shadow-xl p-4 transition-all duration-200">
                                                <div
                                                    class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-2 border-b border-slate-700 pb-1">
                                                    Volunteer Staff
                                                </div>
                                                <div class="text-xs font-bold">{{ $donation->volunteer->name }}</div>
                                                <div class="text-[10px] text-slate-400 mt-1">
                                                    <span class="block">Contact:
                                                        {{ $donation->volunteer->email }}</span>
                                                    <span class="block">Phone:
                                                        {{ $donation->volunteer->phone ?? 'N/A' }}</span>
                                                </div>
                                                <div
                                                    class="absolute top-full left-1/2 -translate-x-1/2 border-8 border-transparent border-t-slate-900">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider border bg-amber-50 text-amber-700 border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-amber-500"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <td class="p-5 text-right">
                                    <a href="{{ route('donations.edit', $donation->id) }}"
                                        class="inline-block bg-slate-100 hover:bg-slate-900 hover:text-white text-slate-600 text-[10px] font-black px-4 py-2 rounded transition-all uppercase tracking-widest border border-slate-200 hover:border-slate-900">
                                        Edit Record
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-4xl mb-4 opacity-20 text-slate-900 italic font-serif">Empty
                                            Archive</span>
                                        <p class="text-slate-400 text-sm italic">No donation records found in this
                                            directory.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
