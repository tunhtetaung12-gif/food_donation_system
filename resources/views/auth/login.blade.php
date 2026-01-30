<x-guest-layout>
    <div class="flex min-h-screen w-full bg-white overflow-hidden">

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-20 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden text-center">
                    <x-application-logo class="w-12 h-12 fill-current text-green-600 mx-auto" />
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-serif font-bold text-gray-900 tracking-tight">
                        {{ __('Welcome Back') }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-2 italic">
                        {{ __('Sign in to your FoodShare account to continue.') }}
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email Address')"
                            class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        <x-text-input id="email"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600 transition duration-200"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            placeholder="example@mail.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center">
                            <x-input-label for="password" :value="__('Password')"
                                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        </div>
                        <x-text-input id="password"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600 transition duration-200"
                            type="password" name="password" required autocomplete="current-password" placeholder="Enter Password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-500">{{ __('Stay signed in') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-green-700 hover:text-green-800 font-medium transition"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <x-primary-button
                            class="w-full justify-center py-4 bg-green-700 hover:bg-green-800 text-white rounded-lg shadow-md transition-all font-bold">
                            {{ __('Secure Login') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-600">
                        {{ __('New to the community?') }}
                        <a href="{{ route('register') }}" class="font-bold text-green-700 hover:underline">
                            {{ __('Create an account') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-green-900 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1593113630400-ea4288922497?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Community Volunteering">

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <x-application-logo class="w-20 h-20 fill-current text-white mb-8" />
                <h1 class="text-5xl font-serif font-bold leading-tight">
                    Small acts, <br>big impact.
                </h1>
                <p class="mt-6 text-lg text-green-50 font-medium max-w-md italic">
                    "We make a living by what we get, but we make a life by what we give."
                </p>

                <div
                    class="mt-12 p-6 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 inline-block max-w-xs">
                    <p class="text-sm font-medium">Community Tip:</p>
                    <p class="text-xs text-green-100 mt-1 italic">Donors can now upload photos of surplus food directly
                        from their mobile dashboard.</p>
                </div>
            </div>

            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-green-400 rounded-full opacity-10 blur-3xl">
            </div>
        </div>

    </div>
</x-guest-layout>

