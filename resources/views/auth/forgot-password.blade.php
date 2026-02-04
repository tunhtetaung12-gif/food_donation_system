<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

            <div class="mb-8 text-center">
                <div class="flex justify-center mb-4">
                    <x-application-logo class="w-12 h-12 fill-current text-green-600" />
                </div>
                <h2 class="text-2xl font-serif font-bold text-gray-900">
                    {{ __('Reset Password') }}
                </h2>
                <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                    {{ __('No problem. Enter your email and we will send you a link to choose a new one.') }}
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email Address')"
                        class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600 transition duration-200"
                        type="email" name="email" :value="old('email')" required autofocus
                        placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <x-primary-button
                        class="w-full justify-center py-3 bg-green-700 hover:bg-green-800 text-white rounded-lg shadow-md transition-all font-bold">
                        {{ __('Send Reset Link') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}"
                    class="text-sm font-bold text-green-700 hover:underline flex items-center justify-center">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Login') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
