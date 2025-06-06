@extends('layouts.app')

@section('content')
<div class="text-center py-20">
    <h2 class="text-2xl font-extrabold text-teal-600 mb-8" style="font-family: 'Press Start 2P', cursive;">Welcome to TO-DUH !!!</h2>
    <p class="mb-8" style="font-family: 'Poppins', sans-serif;">What you can do here:</p>

     <div class="flex flex-col items-center gap-3">
         <div class="bg-gray-200 shadow-xl p-2 flex items-center space-x-4 hover:bg-teal-100 transition-all w-120 rounded-full" style="margin-left: 12px;">
            <img src="{{ asset('images/icon1.png') }}" alt="Task Icon" class="w-10 h-10 ml-2">
            <span class="text-black font-semibold text-lg" style="font-family: 'Poppins', sans-serif;">Create and organize to-do your tasks</span>
        </div>
          <div class="bg-gray-200 shadow-xl p-3 flex items-center space-x-4 hover:bg-teal-100 transition-all w-120 rounded-full" style="margin-left: 12px;">
            <img src="{{ asset('images/icon2.png') }}" alt="Sign Up Icon" class="w-10 h-10 ml-2">
            <span class="text-black font-semibold text-lg" style="font-family: 'Poppins', sans-serif;">Easy Sign Up and Secure Login</span>
        </div>
          <div class="bg-gray-200 shadow-xl p-3 flex items-center space-x-4 hover:bg-teal-100 transition-all w-120 rounded-full" style="margin-left: 12px;">
            <img src="{{ asset('images/icon3.png') }}" alt="Done Icon" class="w-10 h-10 ml-2">
            <span class="text-black font-semibold text-lg" style="font-family: 'Poppins', sans-serif;">Mark things done!</span>
        </div>
          <div class="bg-gray-200 shadow-xl p-3 flex items-center space-x-4 hover:bg-teal-100 transition-all w-120 rounded-full" style="margin-left: 12px;">
            <img src="{{ asset('images/icon4.png') }}" alt="Birthday Icon" class="w-10 h-10 ">
            <span class="text-black font-semibold text-lg" style="font-family: 'Poppins', sans-serif;">Never forget a birthday again</span>
        </div>
    </div>
</div>
@endsection
