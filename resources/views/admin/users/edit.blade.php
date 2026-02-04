<x-app-layout>
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <x-application-logo class="w-10 h-10 fill-current text-green-400" />
                    <span class="text-xl font-serif font-bold tracking-wider">Share & Care</span>
                </div>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 text-slate-300 hover:bg-slate-800 p-3 rounded-lg transition">
                    <span>📊</span><span>Overview</span>
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center space-x-3 bg-green-600 text-white p-3 rounded-lg transition shadow-md">
                    <span>👥</span><span class="font-medium">Manage Users</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-2xl mx-auto">
                <div class="mb-6">
                    <a href="{{ route('admin.users.index') }}"
                        class="text-sm text-green-700 font-bold flex items-center hover:underline">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to User Directory
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-8 border-b border-gray-50 bg-gray-50/50">
                        <h2 class="text-2xl font-serif font-bold text-gray-900">Edit Member Profile</h2>
                        <p class="text-sm text-gray-500 mt-1">Update account details and administrative permissions for
                            <strong>{{ $user->name }}</strong>.</p>
                    </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Full Name')"
                                class="text-xs uppercase tracking-widest font-bold text-gray-600" />
                            <x-text-input id="name" name="name" type="text"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600" :value="old('name', $user->name)"
                                required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email Address')"
                                class="text-xs uppercase tracking-widest font-bold text-gray-600" />
                            <x-text-input id="email" name="email" type="email"
                                class="block mt-1 w-full border-gray-200 focus:ring-green-600" :value="old('email', $user->email)"
                                required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="role" :value="__('Assigned Role')"
                                class="text-xs uppercase tracking-widest font-bold text-gray-600" />
                            <select id="role" name="role"
                                class="block mt-1 w-full border-gray-200 rounded-lg focus:ring-green-600 focus:border-green-600 text-gray-700">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="pt-4 flex items-center justify-between">
                            <button type="button" onclick="window.history.back()"
                                class="text-sm font-bold text-gray-400 hover:text-gray-600 transition">
                                Cancel Changes
                            </button>
                            <x-primary-button class="bg-green-700 hover:bg-green-800 px-8 py-3">
                                {{ __('Update Profile') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
