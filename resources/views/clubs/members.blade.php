@extends('layouts.app')

@section('content')
    <div class="max-w-9xl mx-auto p-6  rounded-lg shadow-sm">
        <h2 class="text-2xl font-bold mb-6">👥 Members of {{ $club->name }}</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 text-red-600 font-medium">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-left text-gray-700">
                    <tr>
                        <th class="px-4 py-2 font-semibold">👤 Name</th>
                        <th class="px-4 py-2 font-semibold">📧 Email</th>
                        <th class="px-4 py-2 font-semibold">🛠 Role</th>
                        <th class="px-4 py-2 font-semibold">🗓 Joined</th>
                        @if ($isOwner)
                            <th class="px-4 py-2 font-semibold">❌ Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($members as $member)
                        <tr>
                            <td class="px-4 py-2">{{ $member->name }}</td>
                            <td class="px-4 py-2">{{ $member->email }}</td>
                            <td class="px-4 py-2 capitalize">
                                {{ $member->pivot->role }}
                                @if ($member->id === auth()->id())
                                    <span class="text-gray-400">(You)</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ $member->pivot->created_at ? $member->pivot->created_at->diffForHumans() : 'N/A' }}
                            </td>
                            @if ($isOwner)
                                <td class="px-4 py-2">
                                    @if ($member->id !== auth()->id())
                                        <form method="POST" action="{{ route('clubs.members.remove', [$club->id, $member->id]) }}"
                                            onsubmit="return confirm('Are you sure you want to remove this member?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Remove</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">You</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection