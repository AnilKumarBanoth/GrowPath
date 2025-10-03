<x-guest-layout>
    <div class=" bg-gray-100 py-6 px-6 sm:px-12 lg:px-24 flex items-center justify-center">
        <!-- Full width container -->
        <div class="w-screen max-w-none space-y-8 mx-auto">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-blue-700">
                    Welcome Back to <span class="text-indigo-600">GrowPath</span>
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Empowering startups to connect, collaborate, and thrive with a vibrant community of innovators.
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Container -->
            <form class="space-y-6 bg-white px-12 pb-5 pt-1 rounded-2xl shadow-xl w-full" method="POST"
                action="{{ route('login') }}">
                @csrf

                <div class="text-4xl font-bold">Login</div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="email" placeholder="ex: username@gmail.com"
                        class="mt-1 block w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="password" placeholder="Enter password"
                        class="mt-1 block w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline focus:outline-none"
                            href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <x-primary-button
                        class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md shadow-md text-lg">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center text-sm text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Join GrowPath</a>
            </div>
        </div>
    </div>
</x-guest-layout>