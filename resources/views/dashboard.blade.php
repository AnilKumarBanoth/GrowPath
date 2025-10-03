@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-10 px-4">
        <div class="max-w-7xl mx-auto">


            <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-6 rounded-2xl shadow mb-10 text-center">
                <h2 class="text-3xl font-bold text-blue-900">Welcome, {{ Auth::user()->name }} 🎉</h2>
                <p class="text-lg text-gray-700 mt-2">Explore your club activities and manage your communities efficiently.
                </p>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Owned Clubs Card -->
                <div class="bg-white p-6 rounded-xl border-l-4 border-blue-600 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-3">
                        <!-- Icon: Crown (indicating ownership/leadership) -->
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8l5 5L20 4M4 16h16M4 20h16" />
                        </svg>
                        <h3 class="text-xl font-semibold text-blue-700">Your Owned Clubs</h3>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mb-1">{{ $ownedClubs->count() }}</p>
                    <p class="text-sm text-gray-500">Clubs you have created and manage.</p>
                    <a href="{{ route('clubs.index') }}"
                        class="mt-3 inline-block text-sm text-blue-600 hover:underline">View Owned Clubs →</a>
                </div>

                <!-- Joined Clubs Card -->
                <div class="bg-white p-6 rounded-xl border-l-4 border-green-600 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-3">

                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 00-3-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-green-700">Joined Clubs</h3>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mb-1">{{ $joinedClubs->count() }}</p>
                    <p class="text-sm text-gray-500">Clubs you are currently a part of.</p>
                    <a href="{{ route('clubs.index') }}"
                        class="mt-3 inline-block text-sm text-green-600 hover:underline">View Joined Clubs →</a>
                </div>

            </div>



            @if($ownedClubs->isNotEmpty())
                <h3 class="text-3xl font-semibold text-gray-800 mt-12 mb-8">📋 Owned Clubs</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($ownedClubs as $club)
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">

                            <h4 class="text-2xl font-semibold text-blue-700 mb-4">{{ $club->name }}</h4>


                            <p class="text-gray-700 text-sm mb-3">
                                <strong>Description:</strong> {{ $club->description ?? 'N/A' }}
                            </p>


                            <p class="text-gray-700 text-sm mb-3">
                                <strong>Category:</strong> {{ $club->category ?? 'N/A' }}
                            </p>


                            <p class="text-gray-700 text-sm mb-3">
                                <strong>Founded:</strong> {{ $club->founded_date ?? 'N/A' }}
                            </p>


                            <div class="space-y-2">
                                <p class="text-gray-700 text-sm mb-3"><strong>Email:</strong> {{ $club->contact_email ?? 'N/A' }}
                                </p>
                                <p class="text-gray-700 text-sm mb-3"><strong>Phone:</strong> {{ $club->contact_phone ?? 'N/A' }}
                                </p>
                                <p class="text-gray-700 text-sm mb-3"><strong>Address:</strong> {{ $club->address ?? 'N/A' }}</p>
                                <p class="text-gray-700 text-sm mb-3"><strong>Website:</strong>
                                    @if($club->website)
                                        <a href="{{ $club->website }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 hover:underline">{{ $club->website }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>

                            <!-- Club Creation Date -->
                            <p class="text-xs text-gray-400 mt-4">Created on: {{ $club->created_at->format('M d, Y') }}</p>

                            <!-- Leave Button -->
                            <!-- View Club Button (Navigates to Posts Section) -->
                            <a href="{{ route('clubs.show', $club->id) }}"
                                class="mt-6 inline-block text-blue-600 hover:text-blue-800 font-medium text-sm transition-all">
                                👁️ View Club
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif


        </div>
    </div>
@endsection