<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - To-Duh!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .form-input-teal::placeholder { color: white; opacity: 0.8; }
        .form-input-teal { color: white; background-color: #3BCFC9; }
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1) brightness(150%); }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <header class="bg-[#0C3D4A] text-white shadow-md">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center">
            <img src="{{ asset('images/logo.png') }}" alt="To-Duh! Logo" class="h-56 w-auto -ml-10">
            <div class="flex items-center space-x-4">
                <button class="hover:opacity-80"><img src="{{ asset('images/moon.png') }}" alt="Dark Mode" class="h-6 w-6"></button>
                <div class="relative">
                    <button type="button" id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ asset('images/user-icon.png') }}" alt="User" class="h-7 w-7" style="filter: invert(1);">
                        <span class="font-semibold">{{ auth()->user()->username ?? 'username' }}</span>
                        <img src="{{ asset('images/chevron-down.png') }}" alt="Options" class="h-5 w-5" style="filter: invert(1);">
                    </button>
                    <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <form method="POST" action="{{ route('logout') }}"><button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button></form>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
                             <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-gray-600 font-semibold px-4 py-2 rounded-lg hover:bg-teal-50 transition-colors"><span>All Events</span></a>
                             <a href="#" class="flex items-center space-x-3 text-gray-600 font-semibold px-4 py-2 rounded-lg hover:bg-teal-50 transition-colors"><span>Calendar</span></a>
                        </nav>
                    </div>
                </aside>

                <section class="lg:col-span-3">
                    <div class="max-w-lg ml-35">
                        <h2 class="pl-45 text-xl text-[#1986AF] mb-6 tracking-wider">EDIT EVENT</h2>

                        <form action="{{ route('events.update', $event) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <!-- Event Name -->
                            <div class="mb-5">
                                <label for="event_name" class="block text-sm font-medium text-gray-700 mb-1">Event<span class="text-red-500">*</span></label>
                                <input type="text" name="event_name" id="event_name" required class="form-input-teal w-full px-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('event_name', $event->name) }}">
                            </div>

                            <!-- Category -->
                            <div class="mb-5">
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category<span class="text-red-500">*</span></label>
                                <select name="category_id" id="category_id" required class="form-input-teal w-full px-4 py-3 border-none rounded-full appearance-none focus:outline-none focus:ring-2 focus:ring-teal-500">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" class="text-black bg-white" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date -->
                            <div class="mb-5 relative">
                                <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Date<span class="text-red-500">*</span></label>
                                <input type="date" name="event_date" id="event_date" required class="form-input-teal w-full px-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d')) }}">
                            </div>

                            <!-- Time -->
                            <div class="mb-5">
                                <label for="event_time" class="block text-sm font-medium text-gray-700 mb-1">Time<span class="text-red-500">*</span></label>
                                <input type="time" name="event_time" id="event_time" required class="form-input-teal w-full px-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('event_time', \Carbon\Carbon::parse($event->event_date)->format('H:i')) }}">
                            </div>

                            <!-- Description -->
                            <div class="mb-5">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <input type="text" name="description" id="description" placeholder="Enter description..." class="form-input-teal w-full px-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('description') }}">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-6">
                                <p class="text-red-500 text-xs mb-2">*This field is required to fill</p>
                                <button type="submit" class="bg-[#1986AF] text-white font-bold py-3 px-20 rounded-full hover:opacity-90 transition-opacity">Edit</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <footer class="w-full">
        <div class="bg-[#0C3D4A] text-white text-xl flex items-center justify-center h-16">
            <span>TO-DUH © 2025</span>
        </div>
    </footer>
</body>
</html>
