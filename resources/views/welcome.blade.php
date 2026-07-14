<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <title>Berkah Mandiri Waterproof | Gudang App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e',
                            950: '#082f49',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'blob': 'blob 7s infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .glass-panel {
            background: rgba(12, 74, 110, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .text-gradient {
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-glow {
            position: relative;
        }
        .btn-glow::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px; right: -2px; bottom: -2px;
            background: linear-gradient(45deg, #38bdf8, #818cf8, #38bdf8);
            z-index: -1;
            border-radius: 9999px;
            filter: blur(10px);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .btn-glow:hover::before {
            opacity: 0.7;
        }
    </style>
</head>

<body class="font-inter min-h-screen bg-slate-950 text-white overflow-hidden selection:bg-brand-500 selection:text-white flex flex-col">

    <!-- Background Elements -->
    <div class="fixed inset-0 w-full h-full z-0 overflow-hidden pointer-events-none">
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiIGZpbGw9Im5vbmUiLz4KPHBhdGggZD0iTTAgMTBoNDBNMTAgMHY0ME0wIDIwaDQwTTIwIDB2NDBNMCAzMGg0ME0zMCAwdjQwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPgo8L3N2Zz4=')] [mask-image:linear-gradient(to_bottom,white,transparent)]"></div>
        
        <!-- Animated Blobs -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-brand-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 w-full px-6 py-6 flex justify-between items-center max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-brand-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <span class="text-xl font-bold tracking-tight">Gudang<span class="text-brand-500">App</span></span>
        </div>
        
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-brand-400 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-brand-400 transition-colors">Masuk</a>
                @endauth
            </div>
        @endif
    </nav>

    <!-- Main Content -->
    <main class="relative z-10 flex-1 flex flex-col justify-center items-center px-6 text-center">
        
        <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/50 border border-slate-700 backdrop-blur-sm mb-8">
                <span class="flex h-2 w-2 rounded-full bg-brand-500"></span>
                <span class="text-xs font-medium text-slate-300">Sistem Manajemen Inventori Digital</span>
            </div>
        </div>

        <h1 class="opacity-0 animate-fade-in-up text-5xl md:text-7xl font-bold tracking-tight mb-6 max-w-4xl" style="animation-delay: 0.2s;">
            Berkah Mandiri <br />
            <span class="text-gradient">Waterproof</span>
        </h1>

        <p class="opacity-0 animate-fade-in-up text-lg md:text-xl text-slate-400 max-w-2xl mb-10 leading-relaxed" style="animation-delay: 0.3s;">
            Kelola stok produk jadi dan bahan baku Anda dengan lebih efisien, terpantau, dan terintegrasi dalam satu sistem yang aman dan responsif.
        </p>

        <div class="opacity-0 animate-fade-in-up flex flex-col sm:flex-row gap-4 justify-center items-center" style="animation-delay: 0.4s;">
            <a href="{{ route('login') }}" class="btn-glow group relative inline-flex items-center justify-center px-8 py-4 font-semibold text-white transition-all duration-200 bg-brand-600 border border-transparent rounded-full hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-600 focus:ring-offset-slate-900 w-full sm:w-auto">
                Masuk ke Dashboard
                <svg class="w-5 h-5 ml-2 -mr-1 transition-transform duration-200 group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>

        <!-- Floating Stats Glass Panel -->
        <div class="opacity-0 animate-fade-in-up glass-panel rounded-2xl p-6 mt-16 max-w-3xl w-full mx-auto grid grid-cols-2 md:grid-cols-3 gap-6 animate-float" style="animation-delay: 0.6s;">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-brand-500/20 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h3 class="font-semibold text-slate-200">Manajemen Produk</h3>
                <p class="text-sm text-slate-400 mt-1">Stok Real-time</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-indigo-500/20 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-slate-200">Laporan Akurat</h3>
                <p class="text-sm text-slate-400 mt-1">Export Data</p>
            </div>
            <div class="flex flex-col items-center col-span-2 md:col-span-1">
                <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-slate-200">Sistem Keamanan</h3>
                <p class="text-sm text-slate-400 mt-1">Multi Role Akses</p>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="relative z-10 w-full py-6 text-center text-slate-500 text-sm border-t border-slate-800/60 mt-auto backdrop-blur-md">
        <p>&copy; <?= date('Y'); ?> Berkah Mandiri Waterproof. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>