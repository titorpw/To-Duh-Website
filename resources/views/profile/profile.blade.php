<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-[#0C3D4A] text-white shadow-md">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="To-Duh! Logo" class="h-56 w-auto -ml-10">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/moon.png') }}" alt="Dark Mode" class="h-6 w-6 cursor-pointer">
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
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow container mx-auto px-4 py-10">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-[#1986AF] mb-6">User Profile</h1>
            <div class="grid grid-cols-3 gap-y-3 text-lg">
                <div class="font-semibold">Name</div>
                <div class="col-span-2">: {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>

                <div class="font-semibold">Username</div>
                <div class="col-span-2">: {{ auth()->user()->username }}</div>

                <div class="font-semibold">Email</div>
                <div class="col-span-2">: {{ auth()->user()->email }}</div>

                <div class="font-semibold">Birth Date</div>
                <div class="col-span-2">: {{ auth()->user()->birth_date }}</div>
            </div>
        </div>
    </main>


    <!-- Footer -->
    <footer class="w-full bg-[#0C3D4A] text-white text-xl flex items-center justify-center h-16">
        <span>TO-DUH © 2025</span>
    </footer>

</body>
</html>
