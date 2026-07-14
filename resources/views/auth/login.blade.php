<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Mengintegrasikan Animasi Kustom ke dalam style tag */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-reverse {
            animation: float 7s ease-in-out infinite reverse;
        }
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .animate-spin-slow {
            animation: spin 12s linear infinite;
        }
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans min-h-screen flex items-center justify-center overflow-x-hidden p-0 sm:p-4 md:p-8 antialiased">

    <div class="bg-white w-full max-w-[1280px] min-h-[100vh] sm:min-h-[85vh] md:min-h-[800px] rounded-none sm:rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden transition-all duration-300">
        
        <div class="w-full md:w-[48%] bg-gradient-to-tr from-blue-700 via-blue-600 to-indigo-600 p-8 lg:p-12 flex flex-col justify-between relative overflow-hidden text-white select-none">
            
            <div class="absolute top-10 left-10 w-24 h-24 bg-white/5 rounded-full blur-xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-indigo-500/20 rounded-full blur-2xl animate-pulse-slow"></div>
            <div class="absolute top-1/3 right-5 w-16 h-16 bg-white/10 rounded-lg rotate-12 animate-spin-slow"></div>
            
            <svg class="absolute top-0 left-0 opacity-10 w-full h-full pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1.5" fill="#ffffff" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>

            <div class="flex items-center space-x-3 z-10">
                <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/30 shadow-lg">
                    <i class="fa-solid fa-boxes-stacked text-white text-xl"></i>
                </div>
                <span class="font-bold text-xl tracking-wider text-white">{{ config('app.name', 'StockVibe') }}</span>
            </div>

            <div class="my-10 flex flex-col items-center justify-center relative z-10 py-8">
                <div class="relative w-full max-w-[340px] h-[340px] flex items-center justify-center">
                    
                    <div class="absolute w-[240px] bg-white rounded-2xl shadow-2xl p-4 text-slate-800 animate-float border border-slate-100 transform -rotate-2 hover:rotate-0 transition-transform duration-300 z-20">
                        <div class="relative rounded-xl overflow-hidden mb-3 bg-gradient-to-br from-amber-100 to-amber-200 p-3 h-24 flex items-center justify-center">
                            <i class="fa-solid fa-box-open text-amber-600 text-5xl animate-bounce-slow"></i>
                            <span class="absolute top-2 right-2 bg-emerald-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">In Stock</span>
                        </div>
                        
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider">SKU-99412</span>
                                <h4 class="font-bold text-sm text-slate-900 leading-tight">Laptop Stand Ergonomis</h4>
                            </div>
                            <span class="bg-indigo-50 text-indigo-600 text-[10px] font-bold px-2 py-1 rounded-md">Rak A-1</span>
                        </div>

                        <div class="space-y-1.5 mt-3 pt-3 border-t border-slate-100 text-[11px] text-slate-500">
                            <div class="flex justify-between">
                                <span><i class="fa-solid fa-circle-info text-blue-500 mr-1"></i> Jumlah Stok:</span>
                                <span class="font-bold text-slate-800">250 Pcs</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fa-solid fa-tag text-emerald-500 mr-1"></i> Harga Jual:</span>
                                <span class="font-bold text-slate-800">Rp 125.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fa-solid fa-truck text-amber-500 mr-1"></i> Supplier:</span>
                                <span class="font-bold text-slate-800">Global Tech</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-4 right-[-10px] w-[180px] bg-slate-900/90 backdrop-blur-md rounded-xl shadow-xl p-3 text-white animate-float-reverse border border-white/10 z-30">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></div>
                            <span class="text-[10px] font-semibold tracking-wide uppercase text-slate-300">Update Aktivitas</span>
                        </div>
                        <p class="text-[11px] font-medium text-slate-200">100 Box Masuk Gudang</p>
                        <span class="text-[9px] text-slate-400"><i class="fa-regular fa-clock mr-1"></i>Baru saja</span>
                    </div>

                    <div class="absolute top-4 left-[-20px] w-[170px] bg-white rounded-xl shadow-lg p-3 text-slate-800 animate-float-reverse border border-red-100 z-10 transform -rotate-6">
                        <div class="flex items-center space-x-2">
                            <span class="p-1.5 bg-rose-50 text-rose-500 rounded-lg">
                                <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                            </span>
                            <div>
                                <h5 class="text-[11px] font-bold text-slate-900">Stok Menipis!</h5>
                                <p class="text-[9px] text-rose-500">Kabel Type-C (Sisa 3)</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-[40%] right-[-15px] w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center text-indigo-600 animate-float z-10">
                        <i class="fa-solid fa-warehouse text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="z-10 text-center md:text-left">
                <div class="flex justify-center md:justify-start space-x-2 mb-4">
                    <span class="w-6 h-1.5 bg-white rounded-full transition-all duration-300"></span>
                    <span class="w-2 h-1.5 bg-white/40 rounded-full transition-all duration-300"></span>
                    <span class="w-2 h-1.5 bg-white/40 rounded-full transition-all duration-300"></span>
                </div>
                <h3 class="text-xl lg:text-2xl font-bold mb-2">Penataan Stok Lebih Cepat & Akurat</h3>
                <p class="text-sm text-indigo-100 max-w-sm leading-relaxed">Kelola gudang, pantau keluar masuk barang, dan dapatkan peringatan stok menipis secara real-time.</p>
            </div>
        </div>

        <div class="w-full md:w-[52%] p-8 sm:p-12 lg:p-16 flex flex-col justify-between bg-white relative">
            
            <div class="flex justify-end text-slate-400 hover:text-slate-600 text-sm font-medium transition-colors cursor-pointer mb-6 md:mb-0">
                <span>Bantuan & Dukungan <i class="fa-solid fa-circle-question ml-1"></i></span>
            </div>

            <div class="max-w-md w-full mx-auto my-auto py-4">
                
                <div class="text-center md:text-left mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 mb-4 shadow-sm border border-indigo-100 transform hover:scale-105 transition-transform duration-300">
                        <i class="fa-solid fa-boxes-packing text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">LOG IN</h2>
                    <p class="text-slate-500 mt-2 text-sm">Please log in to your account</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="nama@perusahaan.com" 
                                required 
                                autofocus 
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 text-sm"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Kata Sandi</label>
                            
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition-colors" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required 
                                class="block w-full pl-11 pr-11 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 text-sm"
                            />
                            <button 
                                type="button" 
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors"
                            >
                                <i id="passwordIcon" class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember_me" 
                            name="remember"
                            class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                        />
                        <label for="remember_me" class="ml-2 text-xs font-medium text-slate-600 select-none cursor-pointer">Remember me</label>
                    </div>

                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/30 transition-all duration-150 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center justify-center space-x-2"
                        >
                            <span>Login Now</span>
                            <i class="fa-solid fa-arrow-right text-sm"></i>
                        </button>
                    </div>
                </form>

            </div>

            <div class="text-center mt-6">
                <p class="text-sm text-slate-500">
                    Belum memiliki akun gudang? 
                    <a href="#" class="text-indigo-600 hover:text-indigo-700 font-bold hover:underline transition-all">Hubungi Admin</a>
                </p>
            </div>

        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-regular', 'fa-eye');
                passwordIcon.classList.add('fa-solid', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-solid', 'fa-eye-slash');
                passwordIcon.classList.add('fa-regular', 'fa-eye');
            }
        }
    </script>
</body>
</html>