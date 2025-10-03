@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto py-6">
        <!-- Profile Header -->
        <header class="flex items-center mb-8 mt-6">
            @php
                $user = Auth::user();
                $profileImage = $user->profile_image ?? null;
                $initial = strtoupper(substr($user->name, 0, 1));
                $bgColors = ['bg-red-500', 'bg-green-500', 'bg-blue-500', 'bg-yellow-500', 'bg-purple-500', 'bg-pink-500'];
                $bgColor = $bgColors[ord($initial) % count($bgColors)];
            @endphp

            @if ($profileImage)
                <img src="{{ $profileImage }}" alt="Profile" class="w-14 h-14 mr-4 rounded-full object-cover border shadow">
            @else
                <div
                    class="w-14 h-14 mr-4 rounded-full flex items-center justify-center text-white text-lg font-semibold {{ $bgColor }}">
                    {{ $initial }}
                </div>
            @endif

            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500">{{ $user->bio ?? 'No Bio Available' }}</p>
            </div>
        </header>

        <!-- Profile Information Form -->
        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Startup Name -->
            <div>
                <x-input-label for="startup_name" :value="__('Startup Name')" />
                <x-text-input id="startup_name" name="startup_name" type="text" class="mt-1 block w-full"
                    :value="old('startup_name', $user->startup_name)" autocomplete="organization" />
                <x-input-error class="mt-2" :messages="$errors->get('startup_name')" />
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <!-- Bio -->
            <div>
                <x-input-label for="bio" :value="__('Bio')" />
                <textarea id="bio" name="bio" rows="3"
                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('bio', $user->bio) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
            </div>

            <!-- Email Verification (if applicable) -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif

            <!-- Save Button -->
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </section>
@endsection