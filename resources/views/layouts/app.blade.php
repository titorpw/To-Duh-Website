<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DUH!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&display=swap" rel="stylesheet">
     @vite('resources/css/app.css')
</head>
<body class="bg-white font-sans">
    <div class="container mx-auto">
        <!-- Header -->
        <header class="text-white flex justify-between items-center h-20 px-6" style="background-color: #0C3D4A;">
            <img src="{{ asset('images/logo.png') }}" alt="TO-DUH!" class="w-56 h-auto">
            <img src="{{ asset('images/moon.png') }}" alt="Dark Mode" class="w-6 h-6 cursor-pointer ml-256.5 mr-auto focus:outline-none">
            <div class="flex items-center space-x-2">
                 <a href="{{ route('signup') }}" class="text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-teal-600 transition-all" style="font-family: 'Poppins', sans-serif;">Sign Up</a>
                <span class="text-white" style="font-size: 1.5rem;">/</span>
                <a href="{{ route('login') }}" class="text-white text-lg font-semibold py-2 px-4 rounded-lg hover:bg-teal-600 transition-all" style="font-family: 'Poppins', sans-serif;">Login</a>
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
