<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-serif font-bold text-gray-900">Share Your Surplus</h2>
                <p class="text-gray-500 mt-2">Fill in the details below to help someone in need today.</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <form action="{{ route('donations.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="food_name" :value="__('What are you donating?')"
                                class="text-xs uppercase font-bold tracking-widest text-gray-600" />
                            <x-text-input id="food_name" name="food_name" type="text"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600"
                                placeholder="e.g. Fresh Vegetable Biryani" required />
                            <x-input-error :messages="$errors->get('food_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="quantity" :value="__('Quantity / Servings')"
                                class="text-xs uppercase font-bold tracking-widest text-gray-600" />
                            <x-text-input id="quantity" name="quantity" type="text"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600"
                                placeholder="e.g. 10 Packets or 5 KG" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="expiry_date" :value="__('Best Before')"
                                class="text-xs uppercase font-bold tracking-widest text-gray-600" />
                            <x-text-input id="expiry_date" name="expiry_date" type="datetime-local"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600" required />
                            <x-input-error :messages="$errors->get('expiry_date')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="pickup_location" :value="__('Pickup Address')"
                            class="text-xs uppercase font-bold tracking-widest text-gray-600" />
                        <x-text-input id="pickup_location" name="pickup_location" type="text"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600"
                            placeholder="Full address or landmark" required />
                        <x-input-error :messages="$errors->get('pickup_location')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Additional Notes (Optional)')"
                            class="text-xs uppercase font-bold tracking-widest text-gray-600" />
                        <textarea id="description" name="description" rows="3"
                            class="block mt-1 w-full border-gray-200 rounded-lg focus:ring-green-600 focus:border-green-600 shadow-sm"
                            placeholder="Any allergy info or special instructions..."></textarea>
                    </div>

                    <div class="pt-4">
                        <x-primary-button
                            class="w-full justify-center py-4 bg-green-700 hover:bg-green-800 shadow-lg shadow-green-900/20 text-lg font-bold transition-all transform active:scale-95">
                            {{ __('Post Donation') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
