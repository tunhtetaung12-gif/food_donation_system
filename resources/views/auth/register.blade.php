<x-guest-layout>
    <div class="flex min-h-screen bg-white">
        <div class="hidden lg:flex lg:w-1/2 bg-green-600 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                class="absolute inset-0 w-full h-full object-cover opacity-40" alt="Food Sharing">
            <div class="relative z-10 flex flex-col justify-center px-16 text-white min-h-[600px]">
                <div class="border-l-2 border-green-400/30 pl-6 mb-12">
                    <x-application-logo class="w-16 h-16 fill-current text-white" />
                </div>

                <h1 class="text-6xl font-serif font-medium leading-[1.1] tracking-tight max-w-2xl">
                    Ensuring No Plate <br>
                    <span class="italic font-serif opacity-90">Remains Vacant.</span>
                </h1>

                <div class="w-24 h-px bg-green-400/40 mt-10 mb-8"></div>

                <p class="text-xl text-green-50/80 font-light leading-relaxed max-w-lg font-sans tracking-wide">
                    Join a distinguished network of donors and volunteers within the FoodShare community, dedicated to
                    the systemic reduction of waste and the global fight against hunger.
                </p>
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

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Full Name')"
                            class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        <x-text-input id="name"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600"
                            type="text" name="name" :value="old('name')" required autofocus
                            placeholder="Enter Your Name" />
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')"
                                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                            <x-text-input id="phone"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600"
                                type="text" name="phone" :value="old('phone')" required placeholder="+95..." />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="role" :value="__('I am joining as a...')"
                                class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                            <select id="role" name="role"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600 rounded-md shadow-sm text-gray-700 py-2.5">
                                <option value="member">Member (Need Food)</option>
                                <option value="donor">Donor (Give Food)</option>
                                <option value="volunteer">Volunteer (Deliver Food)</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Address')"
                            class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        <x-text-input id="address"
                            class="block mt-1 w-full border-gray-200 focus:ring-green-600 focus:border-green-600"
                            type="text" name="address" :value="old('address')" required placeholder="Yangon" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="profile_photo" :value="__('Profile Photo')"
                            class="text-xs uppercase tracking-widest font-semibold text-gray-600" />
                        <input id="profile_photo" name="profile_photo" type="file"
                            class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 border border-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600" />
                        <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
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
