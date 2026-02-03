<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-indigo-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white">Submit Support Request</h2>
                    <p class="text-indigo-100 text-sm">Please tell us what you need and how we can help.</p>
                </div>
                <form action="{{ route('member.requests.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Items Needed</label>
                        <input type="text" name="items_needed" placeholder="e.g. Rice, Milk, Canned vegetables"
                            required value="{{ old('items_needed') }}"
                            class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('items_needed') border-red-500 @enderror">
                        @error('items_needed')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Quantity</label>
                        <input type="text" name="quantities" placeholder="e.g. 2kg, 3 units"
                            value="{{ old('quantities') }}"
                            class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('quantities') border-red-500 @enderror">
                        @error('quantities')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Delivery Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input type="text" name="address" placeholder="Enter your full street address" required
                                value="{{ old('address') }}"
                                class="w-full pl-10 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('address') border-red-500 @enderror">
                        </div>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Urgency Level</label>
                        <select name="urgency" required
                            class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="low" {{ old('urgency') == 'low' ? 'selected' : '' }}>Low (Next 7 days)
                            </option>
                            <option value="medium" {{ old('urgency') == 'medium' ? 'selected' : '' }}>Medium (Next 2-3
                                days)</option>
                            <option value="high" {{ old('urgency') == 'high' ? 'selected' : '' }}>High (Immediate
                                Assistance)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Reason for Request</label>
                        <textarea name="reason" rows="4" placeholder="Briefly explain your situation..." required
                            class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">{{ old('reason') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="{{ route('dashboard') }}"
                            class="text-sm font-bold text-gray-400 hover:text-gray-600">Cancel</a>
                        <button type="submit"
                            class="px-8 py-3 bg-indigo-600 text-white rounded-full font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 active:scale-95">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
