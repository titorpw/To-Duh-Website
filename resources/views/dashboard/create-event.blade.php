<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; }

        .form-input-teal::placeholder {
            color: white;
            opacity: 0.8;
        }
        .form-input-teal {
            color: white;
            background-color: #3BCFC9;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) brightness(150%);
        }

        input[type="date"]:not(:placeholder-shown) + label {
            display: none;
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
                    <div class="max-w-lg ml-35">
                        <h2 class="pl-45 text-xl text-[#1986AF] mb-6 tracking-wider">CREATE EVENT</h2>

                        <form action="{{ route('events.store') }}" method="POST">
                            @csrf

                            <!-- Event Name -->
                            <div class="mb-5">
                                <label for="event_name" class="block text-sm font-medium text-gray-700 mb-1">Event<span class="text-red-500">*</span></label>
                                <input type="text" name="event_name" id="event_name" required placeholder="Enter event name" class="form-input-teal w-full px-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('event_name') }}">
                            </div>

                            <!-- Category -->
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category<span class="text-red-500">*</span></label>
                                <div class="relative" id="category-dropdown">
                                    <input type="hidden" name="category_id" id="category_id" value="{{ old('category_id') }}">
                                    <button type="button" id="category-dropdown-button" class="relative form-input-teal w-full pl-4 pr-12 py-3 border-none rounded-full text-left focus:outline-none focus:ring-2 focus:ring-teal-500">
                                        <span id="category-selected-text" class="truncate">Choose a category</span>
                                        <div id="category-arrow" class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none transition-transform duration-200 ease-in-out">
                                            <img src="{{ asset('images/chevron-down.png') }}" class="w-5 h-5" alt="Dropdown Icon">
                                        </div>
                                    </button>

                                    <div id="category-dropdown-panel" class="hidden absolute z-10 mt-1 w-full bg-white rounded-md shadow-lg max-h-60 overflow-auto">
                                        @foreach (\App\Models\Category::all() as $category)
                                            <div class="cursor-pointer hover:bg-gray-100 p-2 text-gray-800" data-value="{{ $category->id }}" data-text="{{ $category->name }}">
                                                 {{ $category->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <!-- Date -->
                            <div class="mb-5">
                                <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Date<span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                        <img src="{{ asset('images/calendar-field.png') }}" class="w-5 h-5" alt="Calendar Icon">
                                    </div>
                                    <input type="text" name="event_date" id="event_date" required class="date-picker block w-full pl-12 pr-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('event_date') }}" placeholder="Select Date...">
                                </div>
                            </div>

                            <!-- Time -->
                            <div class="mb-5">
                                <label for="event_time" class="block text-sm font-medium text-gray-700 mb-1">Time<span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                        <img src="{{ asset('images/clock-icon.png') }}" class="w-5 h-5" alt="Clock Icon">
                                    </div>
                                    <input type="text" name="event_time" id="event_time" class="time-picker block w-full pl-12 pr-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('time') }}" placeholder="Select time.." >
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-5">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <input type="text" name="description" id="description" placeholder="Enter description..." class="form-input-teal w-full px-4 py-3 border-none rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('description') }}">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-6">
                                <button type="submit" class="bg-[#1986AF] text-white font-bold py-3 px-12 rounded-full hover:opacity-90 transition-opacity">Create</button>
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
