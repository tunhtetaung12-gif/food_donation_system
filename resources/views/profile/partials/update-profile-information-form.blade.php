<section class="max-w-4xl">
    <header class="mb-8">
        <h2 class="text-2xl font-serif font-bold text-gray-900 tracking-tight">
            {{ __('Personal Identity') }}
        </h2>
        <p class="mt-2 text-sm text-gray-500 italic">
            {{ __('Refine your public profile and digital contact details.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('patch')

        <div class="flex flex-col items-center pb-8 border-b border-gray-100">
            <div class="relative group">
                <div class="w-32 h-32 rounded-2xl overflow-hidden ring-4 ring-white shadow-xl relative bg-gray-100">
                    @if ($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                            class="w-full h-full object-cover transform transition group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif

                    <label for="profile_photo"
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </label>
                </div>
                <input id="profile_photo" name="profile_photo" type="file" class="hidden"
                    onchange="this.form.submit()" />
            </div>
            <p class="mt-3 text-[10px] uppercase tracking-widest font-bold text-gray-400">Click photo to update</p>
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <x-input-label for="name" :value="__('Full Name')"
                    class="text-xs uppercase tracking-widest font-bold text-gray-600" />
                <x-text-input id="name" name="name" type="text"
                    class="block w-full border-0 border-b border-gray-200 focus:ring-0 focus:border-green-600 transition-colors bg-transparent px-0"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email Address')"
                    class="text-xs uppercase tracking-widest font-bold text-gray-600" />
                <x-text-input id="email" name="email" type="email"
                    class="block w-full border-0 border-b border-gray-200 focus:ring-0 focus:border-green-600 transition-colors bg-transparent px-0"
                    :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <button form="send-verification"
                            class="text-xs text-red-500 hover:text-red-700 font-bold uppercase tracking-tighter">
                            {{ __('Resend Verification') }}
                        </button>
                    </div>
                @endif
            </div>

            <div class="space-y-2">
                <x-input-label for="phone" :value="__('Phone Number')"
                    class="text-xs uppercase tracking-widest font-bold text-gray-600" />
                <x-text-input id="phone" name="phone" type="text"
                    class="block w-full border-0 border-b border-gray-200 focus:ring-0 focus:border-green-600 transition-colors bg-transparent px-0"
                    :value="old('phone', $user->phone)" autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" />
            </div>

            <div class="space-y-2">
                <x-input-label for="address" :value="__('Location')"
                    class="text-xs uppercase tracking-widest font-bold text-gray-600" />
                <textarea id="address" name="address" rows="1"
                    class="block w-full border-0 border-b border-gray-200 focus:ring-0 focus:border-green-600 transition-colors bg-transparent px-0 resize-none">{{ old('address', $user->address) }}</textarea>
                <x-input-error :messages="$errors->get('address')" />
            </div>
        </div>

        <div class="flex items-center justify-end pt-6">
            <button type="submit"
                class="bg-gray-900 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-green-700 transition-all shadow-lg active:scale-95">
                {{ __('Update Profile') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="fixed bottom-10 right-10 bg-green-600 text-white px-6 py-3 rounded-xl shadow-2xl text-sm font-bold">
                    {{ __('✓ Profile Refined') }}
                </p>
            @endif
        </div>
    </form>
</section>
