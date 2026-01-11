<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Berkah Mandiri Waterproof</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    poppins: ['Poppins', 'sans-serif']
                }
            }
        }
    </script>
    <style>
        .typing {
            overflow: hidden;
            border-right: 3px solid rgba(255, 255, 255, 0.8);
            width: 0;
            animation: typing 3.5s steps(24, end) forwards,
                blink 0.8s infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink {

            0%,
            50%,
            100% {
                border-color: transparent;
            }

            25%,
            75% {
                border-color: rgba(255, 255, 255, 0.8);
            }
        }
    </style>

</head>

<body class="font-poppins min-h-screen flex flex-col relative overflow-hidden bg-[#16335E]">

    <!-- WAVE BACKGROUND -->
    <div class="absolute inset-0 -z-10">
        <!-- Wave 1 -->
        <svg class="absolute bottom-0 w-full h-[45%]" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="rgba(255,255,255,0.08)"
                d="M0,192L80,176C160,160,320,128,480,138.7C640,149,800,203,960,218.7C1120,235,1280,213,1360,202.7L1440,192L1440,320L0,320Z">
            </path>
        </svg>

        <!-- Wave 2 -->
        <svg class="absolute bottom-0 w-full h-[55%]" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="rgba(255,255,255,0.12)"
                d="M0,224L120,213.3C240,203,480,181,720,170.7C960,160,1200,160,1320,160L1440,160L1440,320L0,320Z">
            </path>
        </svg>
    </div>


    <!-- HERO -->
    <main class="flex-1 flex items-center">
        <div class="max-w-4xl mx-auto px-6 text-center text-white">
            <p class="text-blue-200 text-lg mb-3">
                Selamat Datang di Aplikasi Gudang
            </p>

            <h2 class="text-4xl md:text-5xl font-bold mb-4 flex justify-center typing whitespace-nowrap">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 flex justify-center typing whitespace-nowrap">
                    <span>
                        <span class="text-green-400">B</span><span class="text-white">erkah</span>&nbsp;
                    </span>
                    <span>
                        <span class="text-pink-500">M</span><span class="text-yellow-500">andi</span><span class="text-pink-500">r</span><span class="text-yellow-500">i</span>&nbsp;
                    </span>
                    <span class="text-white">Waterproof</span>
                </h2>
            </h2>



            <p class="text-blue-100 text-lg md:text-xl max-w-2xl mx-auto mb-8">
                Mengelola produk dan bahan dengan mudah dan cepat.
            </p>

            <a href="{{ route('login') }}"
                class="inline-block bg-[#0067FF] hover:bg-blue-700 transition px-10 py-4 rounded-xl text-lg font-semibold shadow-lg">
                Log In
            </a>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-6 text-center text-blue-200 text-sm">
        <h3 class="font-semibold text-white mb-1">
            <span>
                <span class="text-green-600">B</span><span class="text-white">erkah</span>&nbsp;
            </span>
            <span>
                <span class="text-pink-500">M</span><span class="text-yellow-500">andi</span><span class="text-pink-500">r</span><span class="text-yellow-500">i</span>&nbsp;
            </span>
            <span class="text-white">Waterproof</span>
        </h3>
        © <?= date('Y'); ?> Berkah Mandiri Waterproof
    </footer>

</body>

</html>