<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="flex justify-center mb-4">
            <x-application-logo class="w-16 h-16 fill-current text-green-600" />
        </div>
        <h2 class="text-2xl font-serif font-bold text-gray-900 tracking-tight">
            {{ __('Create an Account') }}
        </h2>
        <p class="text-sm text-gray-500 mt-2">
            {{ __('Join the FoodShare community and start making an impact.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="name" class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Professional Email')" class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Account Type')" class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <select id="role" name="role" class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 rounded-md shadow-sm transition duration-200 text-gray-700 py-2">
                <option value="donor">Donor (I want to share surplus food)</option>
                <option value="volunteer">Volunteer (I want to help with delivery)</option>
                <option value="receiver">Receiver (I am seeking food assistance)</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="password" class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-gray-900 hover:bg-black text-white rounded-lg shadow-lg transform active:scale-95 transition">
                {{ __('Complete Registration') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm text-gray-600">
            {{ __('Already have a professional account?') }}
            <a href="{{ route('login') }}" class="font-bold text-green-700 hover:underline">
                {{ __('Login') }}
            </a>
        </p>
    </div>
</x-guest-layout>
