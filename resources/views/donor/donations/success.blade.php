<x-app-layout>
    <div class="py-12 bg-white min-h-screen flex items-center justify-center">
        <div class="max-w-xl w-full px-6 text-center">
            <div class="mb-8 flex justify-center">
                <div
                    class="h-24 w-24 bg-green-100 rounded-full flex items-center justify-center text-5xl animate-bounce shadow-inner">
                    🌿
                </div>
            </div>

            <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Amazing Job!</h2>
            <p class="text-xl text-gray-600 mb-8">
                Your donation of <span class="font-bold text-green-600">"{{ $donation->food_name }}"</span> has been
                posted successfully.
            </p>

            <div class="bg-gray-50 rounded-3xl p-8 mb-10 text-left border border-gray-100">
                <h4 class="text-xs uppercase font-black tracking-widest text-gray-400 mb-6">What Happens Next?</h4>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div
                            class="h-6 w-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs mt-1 mr-4">
                            1</div>
                        <p class="text-sm text-gray-700"><strong>Admin Review:</strong> We verify the details and notify
                            nearby volunteers.</p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="h-6 w-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs mt-1 mr-4">
                            2</div>
                        <p class="text-sm text-gray-500"><strong>Volunteer Pickup:</strong> Once assigned, a volunteer
                            will contact you at your pickup location.</p>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="h-6 w-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs mt-1 mr-4">
                            3</div>
                        <p class="text-sm text-gray-500"><strong>Delivery:</strong> The food is delivered to a local
                            shelter or family in need.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                <a href="{{ route('dashboard') }}"
                    class="px-8 py-3 bg-gray-900 text-white rounded-xl font-bold hover:bg-black transition shadow-lg">
                    Back to Dashboard
                </a>
                <a href="{{ route('donations.create') }}"
                    class="px-8 py-3 bg-white text-green-700 border-2 border-green-700 rounded-xl font-bold hover:bg-green-50 transition">
                    Donate More
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
