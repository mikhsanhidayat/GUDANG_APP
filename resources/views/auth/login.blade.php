<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center bg-white px-4">
        
        {{-- <div class="mb-2">
            <img src="{{ asset('images/logo.png') }}" alt="Berkah Mandiri Logo" class="h-24">
        </div> --}}

        <h1 class="text-5xl font-black text-black mb-2 tracking-tight">LOG IN</h1>
        <p class="text-gray-500 mb-8 text-lg">Please log in to your account</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="w-full max-w-md">
            @csrf

            <div class="relative mb-4">
                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Username" 
                       required autofocus 
                       class="block w-full ps-12 p-3.5 bg-[#F0F0FF] border-none rounded-xl text-gray-900 focus:ring-2 focus:ring-blue-400 placeholder-gray-400 shadow-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="relative mb-2">
                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" 
                       type="password" 
                       name="password" 
                       placeholder="Password" 
                       required 
                       class="block w-full ps-12 p-3.5 bg-[#F0F0FF] border-none rounded-xl text-gray-900 focus:ring-2 focus:ring-blue-400 placeholder-gray-400 shadow-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="text-center mb-10 mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-[#007BFF] text-white px-10 py-2.5 rounded-xl font-bold text-base hover:bg-blue-700 shadow-[0_4px_10px_rgba(0,123,255,0.3)] transition-all transform active:scale-95">
                    Login Now
                </button>
            </div>
        </form>
    </div>
</body>
</html>