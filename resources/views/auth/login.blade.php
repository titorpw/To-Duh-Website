<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    {{-- Pastikan Anda memuat JS jika menggunakan toggle password --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans">

    <div class="min-h-screen flex flex-col items-center justify-center ml-5 px-4">
        <div class="w-full max-w-sm">
            <div class="flex justify-center mb-[-70px] mt-[-100px]">
                <img src="{{ asset('images/logo.png') }}" alt="To-Duh! Logo" class="w-90 h-auto">
            </div>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <!-- Username/Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Username/Email<span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent text-gray-700" style="background-color: #3BCFC9;" />
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password<span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required class="w-full px-4 py-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent text-gray-700" style="background-color: #3BCFC9;"/>
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-600">
                           <img id="eye-open" src="{{ asset('images/eye-open.png') }}" alt="Show Password" class="h-6 w-6">
                           <img id="eye-closed" src="{{ asset('images/eye-closed.png') }}" alt="Hide Password" class="h-6 w-6 hidden">
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="mb-4 mt-5 flex flex-col items-center space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2 h-5 w-5 text-teal-600 border-gray-300 rounded focus:ring-teal-500" />
                        <label for="remember" class="text-base text-gray-900">Remember Me</label>
                    </div>
                </div>

                <div class="text-center">
                    <div class="mb-0">
                        <span class="text-red-500 text-sm">*This field is required to fill</span>
                    </div>

                    <button type="submit" class="w-full bg-[#1986AF] text-white font-bold py-3 rounded-full hover:bg-[#1986AF] transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Login</button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">Not On To-Duh Yet? <a href="{{ route('signup') }}" class="font-medium text-teal-600 hover:text-teal-500">Sign Up here!</a></p>
            </div>
        </div>
    </div>
</body>
</html>
