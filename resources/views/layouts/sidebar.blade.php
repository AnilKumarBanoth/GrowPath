<aside class="w-64 bg-white border-r text-gray-800 px-3 py-6 shadow-md h-screen overflow-y-auto">
    <!-- User Info -->
    @if (Auth::check())
        <div class="flex items-center mb-8 mt-16">
            {{-- Circle avatar with first letter --}}
            <div
                class="w-12 h-12 mr-3 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-lg font-semibold uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h4 class="font-semibold text-lg">{{ Auth::user()->name }}</h4>
                <p class="text-sm text-gray-500">{{ Auth::user()->bio ?? 'No Bio Available' }}</p>
                <p class="text-xs text-gray-400">{{ Auth::user()->startup_name ?? 'No Startup' }}</p>
            </div>
        </div>
    @else
        <div class="flex items-center space-x-4 mb-8 mt-16">
            {{-- Guest avatar --}}
            <div
                class="w-12 h-12 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-lg font-semibold uppercase">
                G
            </div>
            <div>
                <h4 class="font-semibold text-lg">Guest</h4>
                <p class="text-sm text-gray-500">No Bio Available</p>
                <span class="text-xs text-gray-400">No Startup</span>
            </div>
        </div>
    @endif

    <!-- Navigation -->
    <nav class="space-y-1">
        <a href="{{ route('dashboard') }}"
            class="block py-2 px-3 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition">📊
            Dashboard</a>

        <!-- 👉 My Clubs links to All Clubs page now -->
        <a href="{{ route('clubs.index') }}"
            class="block py-2 px-3 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition">🧩
            My Clubs</a>

        <hr class="my-4 border-gray-300">

        <h6 class="text-xs text-gray-500 font-semibold uppercase">My Clubs</h6>

        @foreach(Auth::user()->clubs as $club)
            <a href="{{ route('clubs.show', $club->id) }}"
                class="block py-2 px-3 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition">
                💡 {{ $club->name }}
            </a>
        @endforeach

        <a href="{{ route('clubs.create') }}"
            class="mt-4 block py-2 px-3 bg-blue-100 text-blue-700 rounded-md font-medium text-center hover:bg-blue-200 transition">➕
            Create Club</a>
    </nav>
</aside>