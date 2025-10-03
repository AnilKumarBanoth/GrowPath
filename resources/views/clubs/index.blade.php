@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 py-10 px-4">
        <div class="max-w-7xl mx-auto">

            <h2 class="text-4xl font-bold mb-10 text-center text-blue-700">All Clubs</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-6 rounded text-center max-w-2xl mx-auto">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 🧑‍💼 Owned Clubs --}}
            @php
                $ownedClubs = $clubs->filter(fn($club) => $club->user_id == auth()->id());
            @endphp

            @if($ownedClubs->isNotEmpty())
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">🧑‍💼 Your Clubs (Owned)</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
                    @foreach($ownedClubs as $club)
                        <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition border-l-4 border-blue-600">
                            <h3 class="text-2xl font-semibold text-blue-800 mb-2">{{ $club->name }}</h3>

                            <p class="text-gray-700 mb-1"><span class="font-semibold">Description:</span>
                                {{ $club->description ?? 'No description provided.' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Category:</span>
                                {{ $club->category ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Founded Date:</span>
                                {{ $club->founded_date ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Email:</span>
                                {{ $club->contact_email ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Phone:</span>
                                {{ $club->contact_phone ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Address:</span> {{ $club->address ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 mb-1">
                                <span class="font-semibold">Website:</span>
                                @if($club->website)
                                    <a href="{{ $club->website }}" target="_blank"
                                        class="text-blue-600 underline hover:text-blue-800">{{ $club->website }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                            <p class="text-sm text-gray-500 mt-2">Created at: {{ $club->created_at->format('M d, Y') }}</p>

                            {{-- Join/Leave --}}

                            {{-- View Members (only for owner) --}}
                            <div class="mt-4">
                                <a href="{{ route('clubs.members', $club->id) }}" class="text-blue-600 hover:underline">👥 View
                                    Members ({{ $club->members->count() ?? 0 }})</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- 🤝 Joined Clubs (Not Owned) --}}
            @php
                $joinedClubs = $clubs->filter(
                    fn($club) =>
                    $club->members->contains(auth()->id()) && $club->user_id != auth()->id()
                );
            @endphp

            @if($joinedClubs->isNotEmpty())
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">🤝 Clubs You Joined</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
                    @foreach($joinedClubs as $club)
                        <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition border-l-4 border-green-500">
                            <h3 class="text-2xl font-semibold text-blue-800 mb-2">{{ $club->name }}</h3>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Description:</span>
                                {{ $club->description ?? 'No description provided.' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Category:</span>
                                {{ $club->category ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Founded Date:</span>
                                {{ $club->founded_date ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Email:</span>
                                {{ $club->contact_email ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Phone:</span>
                                {{ $club->contact_phone ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Address:</span> {{ $club->address ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 mb-1">
                                <span class="font-semibold">Website:</span>
                                @if($club->website)
                                    <a href="{{ $club->website }}" target="_blank"
                                        class="text-blue-600 underline hover:text-blue-800">{{ $club->website }}</a>
                                @else
                                    N/A
                                @endif
                            </p>

                            <p class="text-sm text-gray-500 mt-2">Created at: {{ $club->created_at->format('M d, Y') }}</p>

                            <div class="mt-4">
                                <form action="{{ route('clubs.leave', $club->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:underline">🚪 Leave Club</button>
                                </form>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('clubs.members', $club->id) }}" class="text-blue-600 hover:underline">👥 View
                                    Members ({{ $club->members->count() ?? 0 }})</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- 🏢 Other Clubs --}}
            @php
                $otherClubs = $clubs->filter(
                    fn($club) =>
                    !$club->members->contains(auth()->id()) && $club->user_id != auth()->id()
                );
            @endphp

            @if($otherClubs->isNotEmpty())
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">🏢 Explore Other Clubs</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($otherClubs as $club)
                        <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition border-l-4 border-gray-400">
                            <h3 class="text-2xl font-semibold text-blue-800 mb-2">{{ $club->name }}</h3>

                            <p class="text-gray-700 mb-1"><span class="font-semibold">Description:</span>
                                {{ $club->description ?? 'No description provided.' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Category:</span>
                                {{ $club->category ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Founded Date:</span>
                                {{ $club->founded_date ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Email:</span>
                                {{ $club->contact_email ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Phone:</span>
                                {{ $club->contact_phone ?? 'N/A' }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Address:</span> {{ $club->address ?? 'N/A' }}
                            </p>
                            <p class="text-gray-700 mb-1">
                                <span class="font-semibold">Website:</span>
                                @if($club->website)
                                    <a href="{{ $club->website }}" target="_blank"
                                        class="text-blue-600 underline hover:text-blue-800">{{ $club->website }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                            <p class="text-sm text-gray-500 mt-2">Created at: {{ $club->created_at->format('M d, Y') }}</p>

                            <div class="mt-4">
                                <form action="{{ route('clubs.join', $club->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline">✅ Join Club</button>
                                </form>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('clubs.members', $club->id) }}" class="text-blue-600 hover:underline">👥 View
                                    Members ({{ $club->members->count() ?? 0 }})</a>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection