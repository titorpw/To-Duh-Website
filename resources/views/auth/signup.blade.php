<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
       @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-white font-sans">

        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="w-full max-w-md flex flex-col">
                <div class="text-center mb-[-70px] mt-[-90px] flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="TO-DUH!" class="w-100 h-auto ml-15"/>
                </div>

                <form action="{{ route('signup.store') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                            <strong class="font-bold">Oops! There were some problems:</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                   <!-- First Name dan Last Name -->
                    <div class="flex mb-4 space-x-8">
                        <!-- First Name -->
                        <div class="w-full">
                            <label for="first_name" class="block text-black font-semibold">First Name<span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" id="first_name" required class="w-60 p-2 mt-0 border rounded-full" style="background-color: #3BCFC9;" value="{{ old('first_name') }}" />
                        </div>

                        <!-- Last Name -->
                        <div class="w-full">
                            <label for="last_name" class="block text-black font-semibold">Last Name<span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" id="last_name" required class="w-60 p-2 mt-0 border rounded-full" style="background-color: #3BCFC9;" value="{{ old('last_name') }}" />
                         </div>
                    </div>

                    <!-- Username dan Email -->
                    <div class="flex mb-4 space-x-8">
                        <!-- Username -->
                        <div class="w-full">
                            <label for="username" class="block text-black font-semibold">Username<span class="text-red-500">*</span></label>
                            <input type="text" name="username" id="username" required class="w-60 p-2 mt-0 border rounded-full" style="background-color: #3BCFC9;" value="{{ old('username') }}" />
                        </div>

                        <!-- Email -->
                        <div class="w-full">
                            <label for="email" class="block text-black font-semibold">Email<span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" required class="w-60 p-2 mt-0 border rounded-full" style="background-color: #3BCFC9;" value="{{ old('email') }}" />
                        </div>
                    </div>

                    <!-- Password dan Verify Password -->
                    <div class="flex mb-4 space-x-8">
                        <!-- Password -->
                        <div class="w-full">
                            <label for="password" class="block text-black font-semibold">Password<span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required class="w-60 p-2 mt-0 border rounded-full" style="background-color: #3BCFC9;" />
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img id="eye-open" src="{{ asset('images/eye-open.png') }}" alt="Show" class="h-6 w-6">
                                    <img id="eye-closed" src="{{ asset('images/eye-closed.png') }}" alt="Hide" class="h-6 w-6 hidden">
                                </button>
                            </div>
                        </div>

                        <!-- Verify Password -->
                        <div class="w-full">
                            <label for="password_confirmation" class="block text-black font-semibold">Verify Password<span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-60 p-2 mt-0 border rounded-full" style="background-color: #3BCFC9;" />
                                <button type="button" id="togglePasswordConfirmation" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img id="eye-open-confirmation" src="{{ asset('images/eye-open.png') }}" alt="Show" class="h-6 w-6">
                                    <img id="eye-closed-confirmation" src="{{ asset('images/eye-closed.png') }}" alt="Hide" class="h-6 w-6 hidden">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Born Date -->
                     <div class="mb-4">
                        <label for="birth_date" class="block text-black font-semibold">Born Date<span class="text-red-500">*</span></label>
                        <input type="date" name="birth_date" id="birth_date" required class="w-130 p-2 mt-0 border rounded-full" style="background-color: #3BCFC9;" value="{{ old('birth_date') }}" />
                    </div>

                    <!-- Sign Up Button -->
                    <div class="text-center mt-6">
                        <button type="submit" class="w-50 ml-15 bg-[#1986AF] text-white py-3 rounded-full hover:bg-[#1986AF] transition-all ">Sign Up</button>
                    </div>

                    <!-- Already have an account? -->
                    <div class="text-center ml-12 mt-2">
                        <a href="{{ route('login') }}" class="text-teal-800 hover:underline text-sm font-medium font-poppins">Already have account? Login here!</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
