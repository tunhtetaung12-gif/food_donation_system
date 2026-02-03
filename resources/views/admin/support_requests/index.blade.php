<x-app-layout>
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        @include('layouts.admin-sidebar')

        <main class="flex-1 overflow-y-auto p-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-800">Member Support Requests</h2>
                    <p class="text-sm text-gray-500 mt-1">Total Pending Requests:
                        {{ $requests->where('status', 'pending')->count() }}</p>
                </div>

                @if (session('success'))
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-lg text-sm animate-bounce">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="p-4 font-bold">Member & Contact</th>
                            <th class="p-4 font-bold">Items & Quantities</th>
                            <th class="p-4 font-bold">Address</th>
                            <th class="p-4 font-bold">Reason</th>
                            <th class="p-4 font-bold">Urgency</th>
                            <th class="p-4 font-bold">Status</th>
                            <th class="p-4 font-bold text-right">Update Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($requests as $request)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $request->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->user->email }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-xs font-bold text-gray-800">{{ $request->items_needed }}</div>
                                    @if ($request->quantities)
                                        <div
                                            class="text-[10px] text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full inline-block mt-1">
                                            Qty: {{ $request->quantities }}
                                        </div>
                                    @else
                                        <div class="text-[10px] text-gray-400 italic mt-1">No quantity specified</div>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-start">
                                        <span class="text-[10px] mt-0.5 mr-1 text-gray-400">📍</span>
                                        <div class="text-xs text-gray-600 leading-tight max-w-[150px]">
                                            {{ $request->address ?? 'No address provided' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="text-xs text-gray-600 italic leading-snug max-w-[200px]"
                                        title="{{ $request->reason }}">
                                        "{{ Str::limit($request->reason, 50) }}"
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-1 text-[9px] font-black rounded uppercase tracking-tighter
                                        {{ $request->urgency == 'high' ? 'bg-red-100 text-red-700' : ($request->urgency == 'medium' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700') }}">
                                        {{ $request->urgency }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm font-bold">
                                    <span
                                        class="{{ $request->status == 'pending' ? 'text-orange-500' : 'text-green-600' }}">
                                        ● {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <form action="{{ route('admin.support.update', $request->id) }}" method="POST"
                                        class="flex items-center justify-end space-x-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-xs border-gray-200 rounded-lg focus:ring-slate-900 focus:border-slate-900 py-1 bg-gray-50">
                                            <option value="pending"
                                                {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved"
                                                {{ $request->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                            <option value="completed"
                                                {{ $request->status == 'completed' ? 'selected' : '' }}>Complete
                                            </option>
                                            <option value="declined"
                                                {{ $request->status == 'declined' ? 'selected' : '' }}>Decline</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400 italic text-sm">
                                    No support requests currently found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $requests->links() }}
            </div>
        </main>
    </div>
</x-app-layout>
