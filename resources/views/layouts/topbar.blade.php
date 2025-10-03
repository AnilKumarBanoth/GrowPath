<header class="bg-white shadow h-16 flex items-center justify-end px-6">
    <div class="flex items-center">
        <button class="mr-4 focus:outline-none">
            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
        <div class="relative">
            <button class="flex items-center focus:outline-none">


                @if (Auth::check())
                    <img src="{{ asset('images/default-profile.png') }}" alt="{{ Auth::user()->name }}"
                        class="rounded-full h-8 w-8 object-cover mr-2">
                    <span class="text-gray-700 text-sm">{{ Auth::user()->name }}</span>
                @else
                    <span class="text-gray-700 text-sm">Guest</span>
                @endif
                <svg class="fill-current h-4 w-4 ml-1 text-gray-500" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</header>