<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DUH!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <header class="bg-[#0C3D4A] text-white shadow-md">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center">
            <!-- Logo -->
            <img src="{{ asset('images/logo.png') }}" alt="To-Duh! Logo" class="h-56 w-auto -ml-10">

            <!-- Right Side Menu -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/moon.png') }}" alt="Dark Mode" class="h-6 w-6 cursor-pointer">

                @auth
                    <!-- Jika user login -->
                    <div class="relative">
                        <button type="button" id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                            <img src="{{ asset('images/user-icon.png') }}" alt="User" class="h-7 w-7" style="filter: invert(1);">
                            <span class="font-semibold">{{ auth()->user()->username }}</span>
                            <img src="{{ asset('images/chevron-down.png') }}" alt="Options" class="h-5 w-5" style="filter: invert(1);">
                        </button>
                        <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika user belum login -->
                    <a href="{{ route('signup') }}" class="text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-teal-600 transition-all" style="font-family: 'Poppins', sans-serif;">Sign Up</a>
                    <span class="text-white text-xl">/</span>
                    <a href="{{ route('login') }}" class="text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-teal-600 transition-all" style="font-family: 'Poppins', sans-serif;">Login</a>
                @endauth
            </div>
        </div>
    </header>
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
