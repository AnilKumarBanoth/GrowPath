<x-guest-layout>
    <div class="min-h-screen bg-gray-100 py-6 px-6 sm:px-12 lg:px-24 flex items-center justify-center">
        <!-- Full width container -->
        <div class="w-screen max-w-none space-y-8 mx-auto">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-blue-700">
                    Register to <span class="text-indigo-600">GrowPath</span>
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Empowering startups to connect, collaborate, and thrive with a vibrant community of innovators.
                </p>
            </div>

            <!-- Form Container -->
            <form class="space-y-6 bg-white px-12 pb-5 pt-3 rounded-2xl shadow-xl w-full" method="POST"
                action="{{ route('register') }}">
                @csrf

                <div class="text-4xl font-bold">Register</div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="name"
                        class="mt-1 block w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Enter your full name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="email"
                        class="mt-1 block w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Enter your email address" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Startup Name -->
                <div class="mt-4">
                    <x-input-label for="startup_name" class="text-sm font-medium text-gray-700">Startup
                        Name</x-input-label>
                    <x-text-input id="startup_name" class="block mt-1 w-full" name="startup_name" type="text"
                        value="{{ old('startup_name') }}" placeholder="Enter your startup name" />
                </div>

                <!-- Bio -->
                <div class="mt-4">
                    <x-input-label for="bio" class="text-sm font-medium text-gray-700">Bio</x-input-label>
                    <textarea
                        class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        id="bio" name="bio" placeholder="Write a brief bio about yourself">{{ old('bio') }}</textarea>
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="phone" class="text-sm font-medium text-gray-700">Phone</x-input-label>
                    <x-text-input class="block mt-1 w-full" id="phone" name="phone" type="text"
                        value="{{ old('phone') }}" placeholder="Enter your phone number" />
                </div>

                <!-- Location -->
                <div class="mt-4">
                    <x-input-label for="location" class="text-sm font-medium text-gray-700">Location</x-input-label>
                    <x-text-input class="block mt-1 w-full" id="location" name="location" type="text"
                        value="{{ old('location') }}" placeholder="Enter your location" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        type="password" name="password" required autocomplete="new-password"
                        placeholder="Create a strong password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                        class="text-sm font-medium text-gray-700" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Re-enter your password" />
                    <x-input-error :messages="$errors->get('password_confirmation')"
                        class="mt-2 text-red-600 text-sm" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>