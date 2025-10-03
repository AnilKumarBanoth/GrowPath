<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowPath - Welcome</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-6 py-12">
        <div
            class="bg-white rounded-3xl shadow-xl border border-gray-200 p-10 md:p-16 w-full max-w-3xl text-center space-y-6">

            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-700 leading-tight">
                Welcome to <span class="text-indigo-600">GrowPath</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-700 max-w-2xl mx-auto">
                Where startups meet success. Build your network, collaborate with industry professionals, and unlock new
                opportunities for business growth and innovation.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-6">
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-full transition duration-300 shadow">
                    Get Started
                </a>
                <a href="{{ route('login') }}"
                    class="bg-white border border-indigo-600 hover:bg-indigo-50 text-indigo-600 font-semibold px-8 py-3 rounded-full transition duration-300 shadow">
                    Login
                </a>
            </div>
        </div>
    </div>

</body>

</html>