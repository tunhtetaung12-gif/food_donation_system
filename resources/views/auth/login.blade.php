<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="flex justify-center mb-4">
            <x-application-logo class="w-16 h-16 fill-current text-green-600" />
        </div>
        <h2 class="text-2xl font-serif font-bold text-gray-900 tracking-tight">
            {{ __('Sign in to FoodShare') }}
        </h2>
        <p class="text-sm text-gray-500 mt-2">
            {{ __('Enter your professional credentials to continue.') }}
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            </div>
            <x-text-input id="password" class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-500">{{ __('Stay signed in') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-green-700 hover:text-green-800 font-medium transition" href="{{ route('password.request') }}">
                    {{ __('Reset password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-gray-900 hover:bg-black text-white rounded-lg shadow-lg transform active:scale-95 transition">
                {{ __('Secure Login') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm text-gray-600">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="font-bold text-green-700 hover:underline">
                {{ __('Register here') }}
            </a>
        </p>
    </div>
</x-guest-layout>
