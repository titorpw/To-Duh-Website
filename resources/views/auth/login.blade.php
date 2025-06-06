<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white font-sans">

    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md flex flex-col">
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="TO-DUH!" class="w-80 h-auto">
            </div>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-black font-semibold">Email<span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" required class="w-full p-2 border rounded-full" style="background-color: #3BCFC9;" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-black font-semibold">Password<span class="text-red-500">*</span></label>
                    <input type="password" name="password" id="password" required class="w-full p-2 border rounded-full" style="background-color: #3BCFC9;" />
                </div>

                <!-- Remember Me -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2" />
                    <label for="remember" class="text-black">Remember Me</label>
                </div>

                <div class="text-center mt-6">
                    <button type="submit" class="w-full bg-teal-500 text-white py-3 rounded-full hover:bg-teal-600 transition-all">Login</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p>Don't have an account? <a href="{{ route('signup') }}" class="text-teal-500">Sign Up here</a></p>
            </div>
        </div>
    </div>

</body>
</html>
