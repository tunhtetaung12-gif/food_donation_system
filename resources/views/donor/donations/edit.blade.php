<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex mb-5 text-gray-500 text-xs tracking-wide uppercase font-semibold" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
                <span class="mx-2 text-gray-300">/</span>
                <a href="{{ route('donations.index') }}" class="hover:text-green-600 transition">My History</a>
                <span class="mx-2 text-gray-300">/</span>
                <span class="text-gray-800">Edit Donation</span>
            </nav>

            <div
                class="bg-white shadow-xl shadow-slate-200/60 border border-slate-200 rounded-lg overflow-hidden flex flex-col md:flex-row">

                <div class="md:w-1/4 bg-slate-900 p-8 text-white">
                    <div class="mb-8">
                        <span class="text-green-400 text-[10px] font-black uppercase tracking-[0.2em]">Registry
                            Office</span>
                        <h2 class="text-xl font-serif mt-2 italic">Modification Form</h2>
                    </div>

                    <div class="space-y-6 text-xs text-slate-400 leading-relaxed">
                        <p>Please ensure all records are accurate. Updates are logged for logistics tracking.</p>
                        <div class="pt-6 border-t border-slate-800">
                            {{-- <span class="block text-slate-500 mb-1">Entry ID:</span>
                            <span
                                class="text-slate-200 font-mono">#DN-{{ str_pad($donation->id, 5, '0', STR_PAD_LEFT) }}</span> --}}
                        </div>
                    </div>
                </div>

                <div class="flex-1 p-10">
                    <form action="{{ route('donations.update', $donation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-bold text-slate-800 mb-8 border-b border-slate-100 pb-4">Donation
                            Particulars</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="md:col-span-2">
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Item
                                    Designation</label>
                                <input type="text" name="food_name"
                                    value="{{ old('food_name', $donation->food_name) }}"
                                    class="w-full border-slate-200 rounded bg-white text-slate-800 focus:ring-0 focus:border-slate-900 transition-all px-4 py-2.5 shadow-sm"
                                    required>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Quantity
                                    / Weight</label>
                                <input type="text" name="quantity" value="{{ old('quantity', $donation->quantity) }}"
                                    class="w-full border-slate-200 rounded bg-white focus:ring-0 focus:border-slate-900 transition-all px-4 py-2.5 shadow-sm"
                                    required>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Expiration
                                    Protocol</label>
                                <input type="datetime-local" name="expiry_date"
                                    value="{{ old('expiry_date', $donation->expiry_date->format('Y-m-d\TH:i')) }}"
                                    class="w-full border-slate-200 rounded bg-white focus:ring-0 focus:border-slate-900 transition-all px-4 py-2.5 shadow-sm"
                                    required>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Origin
                                    (Pickup Point)</label>
                                <input type="text" name="pickup_location"
                                    value="{{ old('pickup_location', $donation->pickup_location) }}"
                                    class="w-full border-slate-200 rounded bg-white focus:ring-0 focus:border-slate-900 transition-all px-4 py-2.5 shadow-sm"
                                    required>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Target
                                    Destination</label>
                                <input type="text" name="place" value="{{ old('place', $donation->place) }}"
                                    class="w-full border-slate-200 rounded bg-white focus:ring-0 focus:border-slate-900 transition-all px-4 py-2.5 shadow-sm"
                                    required>
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Additional
                                    Logistics Notes</label>
                                <textarea name="description" rows="3"
                                    class="w-full border-slate-200 rounded bg-white focus:ring-0 focus:border-slate-900 transition-all px-4 py-2.5 shadow-sm">{{ old('description', $donation->description) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-12 pt-6 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('donations.index') }}"
                                class="text-xs font-bold text-slate-400 hover:text-slate-900 transition underline underline-offset-4">
                                Discard Changes
                            </a>
                            <button type="submit"
                                class="bg-slate-900 hover:bg-black text-white text-xs font-bold px-10 py-3 rounded uppercase tracking-widest transition-all shadow-md active:scale-95">
                                Save Official Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
