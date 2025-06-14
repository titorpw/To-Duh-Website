<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Calendar</title>

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

    <style>
        body { font-family: 'Poppins', sans-serif; }

        :root {
            --fc-border-color: #e5e7eb;
            --fc-today-bg-color: rgba(34, 172, 177, 0.1);
            --fc-event-bg-color: #22ACB1;
            --fc-event-border-color: #22ACB1;
            --fc-event-text-color: #ffffff;
        }
        .fc .fc-daygrid-day.fc-day-today {
            background-color: var(--fc-today-bg-color);
        }
        .fc .fc-daygrid-day-number {
            padding: 0.5em;
            font-weight: 500;
        }
        .fc .fc-event {
            padding: 3px 6px;
            font-weight: 600;
            border-radius: 4px;
        }
        .fc-h-event {
            background-color: var(--fc-event-bg-color);
            border-color: var(--fc-event-border-color);
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
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Profile
                    </a>    
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
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-[#22ACB1] font-semibold px-4 py-2 rounded-lg hover:bg-teal-50 transition-colors">
                                <span class="icon-mask icon-events h-6 w-6"></span>
                                <span>All Events</span>
                            </a>
                            <a href="{{ route('calendar.index') }}" class="flex items-center space-x-3 text-[#22ACB1] font-semibold px-4 py-2 rounded-lg bg-teal-50 hover:bg-teal-100 transition-colors">
                                <span class="icon-mask icon-calendar h-6 w-6"></span>
                                <span>Calendar</span>
                            </a>
                        </nav>
                    </div>
                </aside>

                <section class="lg:col-span-3">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-2">
                            <button id="cal-prev" class="p-2 rounded-md hover:bg-gray-100">
                                <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button id="cal-next" class="p-2 rounded-md hover:bg-gray-100">
                                <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                             <button id="cal-today" class="px-4 py-1.5 border border-gray-300 text-gray-700 font-semibold text-sm rounded-md hover:bg-gray-50">
                                today
                            </button>
                        </div>
                        <!-- Judul Tengah -->
                        <h2 id="cal-title" class="text-xl font-bold text-gray-800"></h2>
                        <div class="w-40"></div>
                    </div>

                    <div id='calendar'></div>
                </section>
            </div>
        </div>
    </main>

    <footer class="w-full">
        <div class="bg-[#0C3D4A] text-white text-xl flex items-center justify-center h-12">
            <span>TO-DUH © 2025</span>
        </div>
    </footer>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
</body>
</html>
