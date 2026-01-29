<x-guest-layout>
    <div class="flex min-h-screen bg-white">
        <div class="hidden lg:flex lg:w-1/2 bg-green-600 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                class="absolute inset-0 w-full h-full object-cover opacity-40" alt="Food Sharing">

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <x-application-logo class="w-20 h-20 fill-current text-white mb-8" />
                <h1 class="text-5xl font-serif font-bold leading-tight">
                    Making sure <br>no plate goes empty.
                </h1>
                <p class="mt-6 text-lg text-green-50 font-medium max-w-md">
                    Join thousands of donors and volunteers in the FoodShare community to reduce waste and fight hunger.
                </p>
                <div class="mt-12 flex space-x-6">
                    <div class="flex flex-col">
                        <span class="text-3xl font-bold">5k+</span>
                        <span class="text-sm uppercase tracking-widest text-green-200">Meals Shared</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-bold">1k+</span>
                        <span class="text-sm uppercase tracking-widest text-green-200">Volunteers</span>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-green-500 rounded-full opacity-20"></div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white overflow-y-auto">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden text-center">
                    <x-application-logo class="w-12 h-12 fill-current text-green-600 mx-auto" />
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-serif font-bold text-gray-900 tracking-tight">
                        {{ __('Create an Account') }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-2 italic">
                        {{ __('Join the FoodShare community and start making an impact.') }}
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Full Name')"
                            class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        <x-text-input id="name"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600"
                            type="text" name="name" :value="old('name')" required autofocus placeholder="Enter Your Name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email Address')"
                            class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        <x-text-input id="email"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600"
                            type="email" name="email" :value="old('email')" required placeholder="example@mail.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="role" :value="__('I am joining as a...')"
                            class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        <select id="role" name="role"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600 rounded-md shadow-sm text-gray-700 py-2.5">
                            <option value="donor">Donor (I have food to share)</option>
                            <option value="volunteer">Volunteer (I want to help deliver)</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="password" :value="__('Password')"
                                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                            <x-text-input id="password"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600"
                                type="password" name="password" required placeholder="Enter Password" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm')"
                                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                            <x-text-input id="password_confirmation"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600"
                                type="password" name="password_confirmation" required placeholder="Re-Type Password" />
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />

                    <div class="pt-4">
                        <x-primary-button
                            class="w-full justify-center py-4 bg-green-700 hover:bg-green-800 text-white rounded-lg shadow-md transition-all font-bold">
                            {{ __('Complete Registration') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="font-bold text-green-700 hover:underline">
                            {{ __('Sign In') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>


{{-- <x-guest-layout>
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
            <x-input-label for="name" :value="__('Full Name')"
                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="name"
                class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Enter Your Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Professional Email')"
                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                type="email" name="email" :value="old('email')" required autocomplete="username"
                placeholder="example@mail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Account Type')"
                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <select id="role" name="role"
                class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 rounded-md shadow-sm transition duration-200 text-gray-700 py-2">
                <option value="donor">Donor (I want to share surplus food)</option>
                <option value="volunteer">Volunteer (I want to help with delivery)</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')"
                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full bg-gray-50 border-gray-300 focus:bg-white focus:ring-1 focus:ring-green-600 transition duration-200"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button
                class="w-full justify-center py-3 bg-gray-900 hover:bg-black text-white rounded-lg shadow-lg transform active:scale-95 transition">
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
</x-guest-layout> --}}
