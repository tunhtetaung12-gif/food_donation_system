<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="h-32 bg-slate-900"></div>
            <div class="px-8 pb-8">
                <div class="relative flex justify-between items-end -mt-12 mb-6">
                    <div class="p-1 bg-white rounded-2xl shadow-lg">
                        @if ($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                class="w-24 h-24 rounded-xl object-cover">
                        @else
                            <div
                                class="w-24 h-24 bg-slate-100 rounded-xl flex items-center justify-center text-2xl font-bold text-slate-400">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('admin.users.edit', $user) }}"
                        class="bg-slate-900 text-white px-6 py-2 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-green-600 transition">
                        Edit Profile
                    </a>
                </div>

                <h1 class="text-3xl font-serif font-bold text-gray-900">{{ $user->name }}</h1>
                <p class="text-gray-500 uppercase text-[10px] tracking-[0.2em] font-black mt-1">
                    {{ $user->getRoleNames()->first() }}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 border-t border-gray-50 pt-8">
                    <div>
                        <h4 class="text-[10px] uppercase font-black text-slate-400 tracking-widest mb-1">Contact Email
                        </h4>
                        <p class="text-gray-700 font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase font-black text-slate-400 tracking-widest mb-1">Phone Number
                        </h4>
                        <p class="text-gray-700 font-medium">{{ $user->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <h4 class="text-[10px] uppercase font-black text-slate-400 tracking-widest mb-1">Primary Address
                        </h4>
                        <p class="text-gray-700 font-medium">{{ $user->address ?? 'No address provided' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
