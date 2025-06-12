<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .collapsible-icon {
            transition: transform 0.3s ease-in-out;
        }
        .collapsible-header.open .collapsible-icon {
            transform: rotate(180deg);
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .icon-mask {
            display: inline-block;
            background-color: #22ACB1;
            -webkit-mask-size: contain;
            mask-size: contain;
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-position: center;
            mask-position: center;
        }
        .icon-events {
            -webkit-mask-image: url("{{ asset('images/events-icon.png') }}");
            mask-image: url("{{ asset('images/events-icon.png') }}");
        }
        .icon-calendar {
            -webkit-mask-image: url("{{ asset('images/calendar-icon.png') }}");
            mask-image: url("{{ asset('images/calendar-icon.png') }}");
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <header class="bg-[#0C3D4A] text-white shadow-md">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="To-Duh! Logo" class="h-56 w-auto -ml-10">

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

    <!-- Sidebar Kiri -->
    <main class="container mx-auto p-4 sm:p-6 md:px-8 flex-grow">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <aside class="lg:col-span-1">
                    <div class="space-y-4">
                        <a href="{{ route('events.create') }}" class="w-full bg-gray-200 text-slate-800 font-bold py-3 px-4 rounded-full flex items-center justify-center space-x-3 hover:bg-gray-300 transition-colors">
                            <span class="flex items-center justify-center bg-slate-800 h-7 w-7 rounded-full">
                                <img src="{{ asset('images/plus-icon.png') }}" alt="Add" class="h-4 w-4" style="filter: invert(1);">
                            </span>
                            <span>Add New Event</span>
                        </a>
                        <nav class="space-y-2">
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-[#22ACB1] font-semibold px-4 py-2 rounded-lg bg-teal-50 hover:bg-teal-100 transition-colors">
                                <span class="icon-mask icon-events h-6 w-6"></span>
                                <span>All Events</span>
                            </a>
                            <a href="{{ route('calendar.index') }}" class="flex items-center space-x-3 text-[#22ACB1] font-semibold px-4 py-2 rounded-lg hover:bg-teal-100 transition-colors">
                                <span class="icon-mask icon-calendar h-6 w-6"></span>
                                <span>Calendar</span>
                            </a>
                        </nav>
                    </div>
                </aside>

                <section class="lg:col-span-3">
                    <form id="search-form" method="GET" action="{{ route('dashboard') }}" data-base-url="{{ route('dashboard') }}" class="flex flex-col gap-4 mb-6">
                        <!-- Baris Pencarian -->
                        <div class="relative w-full">
                            <input type="text" name="search" id="main_search" placeholder=" " value="{{ request('search') }}" class="peer w-full bg-gray-100 border-2 border-gray-200 rounded-full py-2 px-4 text-center focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" />
                            <label for="main_search" class="absolute inset-0 flex items-center justify-center text-gray-500 pointer-events-none transition-opacity opacity-100 peer-focus:opacity-0 peer-[:not(:placeholder-shown)]:opacity-0">
                                <img src="{{ asset('images/search-icon.png') }}" alt="Search" class="h-5 w-5 mr-2">
                                <span>Search</span>
                            </label>
                        </div>

                        <!-- Baris Filter Kategori -->
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('dashboard', ['search' => request('search')]) }}"
                               class="font-semibold text-sm px-5 py-1.5 rounded-full transition-colors {{ !request('category') ? 'bg-[#22ACB1] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                All
                            </a>
                            @foreach ($categories as $category)
                                <a href="{{ route('dashboard', ['category' => $category->id, 'search' => request('search')]) }}"
                                   class="font-semibold text-sm px-5 py-1.5 rounded-full transition-colors {{ request('category') == $category->id ? 'bg-[#22ACB1] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </form>

                    <!-- Daftar Event -->
                    <div class="space-y-6">
                        <!-- Bagian Upcoming -->
                        <div>
                           <div class="collapsible-header bg-[#377684] text-white font-bold py-3 px-4 rounded-lg grid grid-cols-3 items-center cursor-pointer">
                                <div></div>
                                <span class="text-center">Upcoming</span>
                                <img src="{{ asset('images/chevron-down.png') }}" alt="Toggle" class="collapsible-icon h-5 w-5 justify-self-end" style="filter: invert(1);">
                            </div>
                            <div id="upcoming-events-list" class="collapsible-content space-y-2 mt-2 hidden">
                                @forelse ($upcomingEvents as $event)
                                    <div id="event-item-{{ $event->id }}" class="event-item flex items-center justify-between p-3 border-b hover:bg-gray-50 rounded-md transition-all duration-300">
                                        <div class="flex items-center space-x-4">
                                            <button class="event-checkbox flex-shrink-0 w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all duration-300"
                                                    data-url="{{ route('events.toggleComplete', $event) }}">
                                                <svg class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                            <div class="event-details">
                                                <p class="font-semibold text-gray-800 transition-all duration-300">{{ $event->name }}</p>
                                                <p class="text-sm text-gray-500 flex items-center space-x-1.5">
                                                    <img src="{{ asset('images/calendar-icon-small.png') }}" alt="Date" class="h-4 w-4">
                                                    <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y, H:i') }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 text-gray-400">
                                            <a href="{{ route('events.edit', $event) }}" class="hover:text-blue-500"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="h-5 w-5"></a>
                                            <button class="event-delete-btn hover:text-red-500" data-url="{{ route('events.destroy', $event) }}">
                                                <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="h-5 w-5">
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 py-4">No upcoming events found.</p>
                                @endforelse
                            </div>
                        </div>

                        <div>
                            <div class="collapsible-header bg-[#377684] text-white font-bold py-3 px-4 rounded-lg grid grid-cols-3 items-center cursor-pointer">
                                <div></div>
                                <span class="text-center">Completed</span>
                                <img src="{{ asset('images/chevron-down.png') }}" alt="Toggle" class="collapsible-icon h-5 w-5 justify-self-end" style="filter: invert(1);">
                            </div>
                            <div id="completed-events-list" class="collapsible-content space-y-2 mt-2 hidden">
                                @forelse ($completedEvents as $event)
                                    <div class="flex items-center justify-between p-3 border-b hover:bg-gray-50 rounded-md">
                                        <div class="flex items-center space-x-4">
                                            <input type="checkbox" class="h-5 w-5 rounded-full text-teal-600 focus:ring-teal-500 border-gray-300" checked disabled>
                                            <div>
                                                <p class="font-semibold text-gray-800 line-through">{{ $event->name }}</p>
                                                <p class="text-sm text-gray-500 flex items-center space-x-1.5">
                                                    <img src="{{ asset('images/calendar-icon-small.png') }}" alt="Date" class="h-4 w-4">
                                                    <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y, H:i') }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 py-4">No completed events yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full">
        <div class="bg-[#0C3D4A] text-white text-xl flex items-center justify-center h-12">
            <span>TO-DUH © 2025</span>
        </div>
    </footer>

    <div id="delete-confirmation-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Confirm Deletion</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this event? This action cannot be undone.</p>
            <div class="flex justify-end space-x-4">
                <button id="cancel-delete-btn" class="px-6 py-2 rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
                <button id="confirm-delete-btn" class="px-6 py-2 rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors">
                    Delete
                </button>
            </div>
        </div>
    </div>
</body>
</html>
