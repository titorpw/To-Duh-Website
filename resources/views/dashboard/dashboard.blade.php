<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .collapsible-icon {
            transition: transform 0.3s ease-in-out;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <header class="bg-[#0C3D4A] text-white shadow-md">
        <div class="container mx-auto px-6 pr-6 h-20 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="To-Duh! Logo" class="h-56 w-auto -ml-10">

            <!-- Menu Pengguna -->
            <div class="flex items-center space-x-4">
                <button class="hover:opacity-80">
                    <img src="{{ asset('images/moon.png') }}" alt="Dark Mode" class="h-6 w-6">
                </button>
                <div class="relative">
                    <button type="button" id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ asset('images/user-icon.png') }}" alt="User" class="h-7 w-7" style="filter: invert(1);">
                        <span class="font-semibold">{{ auth()->user()->username ?? 'username' }}</span>
                        <img src="{{ asset('images/chevron-down.png') }}" alt="Options" class="h-5 w-5" style="filter: invert(1);">
                    </button>

                    <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="container mx-auto p-4 sm:p-6 md:px-8 flex-grow">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <aside class="lg:col-span-1">
                    <div class="space-y-4">
                        <button class="w-full bg-gray-800 text-white font-bold py-3 px-4 rounded-full flex items-center justify-center space-x-2 hover:bg-gray-700 transition-colors">
                            <img src="{{ asset('images/plus-icon.png') }}" alt="Add" class="h-5 w-5">
                            <span>Add New Event</span>
                        </button>
                        <nav class="space-y-2">
                            <a href="#" class="flex items-center space-x-3 text-gray-700 font-semibold px-4 py-2 rounded-lg bg-teal-50 hover:bg-teal-100 transition-colors">
                                <img src="{{ asset('images/events-icon.png') }}" alt="All Events" class="h-6 w-6">
                                <span>All Events</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 text-gray-600 font-semibold px-4 py-2 rounded-lg hover:bg-teal-100 transition-colors">
                                <img src="{{ asset('images/calendar-icon.png') }}" alt="Calendar" class="h-6 w-6">
                                <span>Calendar</span>
                            </a>
                        </nav>
                    </div>
                </aside>

                <section class="lg:col-span-3">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <div class="relative flex-grow">
                            <input type="text" placeholder="Search" class="w-full bg-gray-100 border-2 border-gray-200 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <img src="{{ asset('images/search-icon.png') }}" alt="Search" class="h-5 w-5">
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="bg-gray-200 text-gray-700 font-semibold text-sm px-4 py-1 rounded-full hover:bg-gray-300">+ category 1</button>
                            <button class="bg-gray-200 text-gray-700 font-semibold text-sm px-4 py-1 rounded-full hover:bg-gray-300">+ category 2</button>
                        </div>
                    </div>

                    <!-- Daftar Event -->
                    <div class="space-y-6">
                        <!-- Bagian Upcoming -->
                        <div>
                            <div class="collapsible-header bg-[#38B2AC] text-white font-bold py-3 px-4 rounded-lg flex justify-between items-center cursor-pointer">
                                <span>Upcoming</span>
                                <img src="{{ asset('images/chevron-down.png') }}" alt="Toggle" class="collapsible-icon h-5 w-5" style="filter: invert(1);">
                            </div>
                            <div class="collapsible-content space-y-2 mt-2">
                                <div class="flex items-center justify-between p-3 border-b hover:bg-gray-50 rounded-md">
                                    <div class="flex items-center space-x-4">
                                        <input type="checkbox" class="h-5 w-5 rounded-full text-teal-600 focus:ring-teal-500 border-gray-300">
                                        <div>
                                            <p class="font-semibold text-gray-800">event name</p>
                                            <p class="text-sm text-gray-500 flex items-center space-x-1.5">
                                                <img src="{{ asset('images/calendar-icon-small.png') }}" alt="Date" class="h-4 w-4">
                                                <span>02/02/2022, 17.00</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <button class="hover:opacity-70"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="h-5 w-5"></button>
                                        <button class="hover:opacity-70"><img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="h-5 w-5"></button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between p-3 border-b hover:bg-gray-50 rounded-md">
                                    <div class="flex items-center space-x-4"> <input type="checkbox" class="h-5 w-5 rounded-full text-teal-600 focus:ring-teal-500 border-gray-300"> <div> <p class="font-semibold text-gray-800">event name</p> <p class="text-sm text-gray-500 flex items-center space-x-1.5"> <img src="{{ asset('images/calendar-icon-small.png') }}" alt="Date" class="h-4 w-4"> <span>02/02/2022, 17.00</span> </p> </div> </div> <div class="flex items-center space-x-3"> <button class="hover:opacity-70"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="h-5 w-5"></button> <button class="hover:opacity-70"><img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="h-5 w-5"></button> </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Completed -->
                        <div>
                            <div class="collapsible-header bg-[#38B2AC] text-white font-bold py-3 px-4 rounded-lg flex justify-between items-center cursor-pointer">
                                <span>Completed</span>
                                <img src="{{ asset('images/chevron-down.png') }}" alt="Toggle" class="collapsible-icon h-5 w-5">
                            </div>
                            <div class="collapsible-content space-y-2 mt-2 hidden">
                                {{-- Contoh Event Item untuk Completed --}}
                                <div class="flex items-center justify-between p-3 border-b">
                                    <div class="flex items-center space-x-4"> <input type="checkbox" class="h-5 w-5 rounded-full text-teal-600 focus:ring-teal-500 border-gray-300" checked> <div> <p class="font-semibold text-gray-800 line-through">event name</p> <p class="text-sm text-gray-500 flex items-center space-x-1.5"> <img src="{{ asset('images/calendar-icon-small.png') }}" alt="Date" class="h-4 w-4"> <span>02/02/2022, 17.00</span> </p> </div> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <!-- Footer Halaman -->
    <footer class="w-full">
        <div class="bg-[#0C3D4A] text-white text-lg flex items-center justify-center h-12">
            <span>TO-DUH © 2025</span>
        </div>
    </footer>

</body>
</html>
