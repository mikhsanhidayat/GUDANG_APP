<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gudang App | Horizon UI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('horizon_assets/favicon.ico') }}" />
    
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
    
    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #F4F7FE; }
        .sidebar { transition: all 0.3s; }
        .main-content { transition: all 0.3s; }
        .horizon-card {
            background-color: white;
            border-radius: 20px;
            box-shadow: 14px 17px 40px 4px rgba(112, 144, 176, 0.08);
            border: none;
        }
    </style>
</head>
<body class="text-navy-700 antialiased bg-[#F4F7FE]">
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="main-content min-h-screen p-4 xl:p-8 relative h-full xl:ml-[290px] xl:w-[calc(100%-290px)]">
        <!-- Navbar -->
        @include('layouts.header')

        <!-- Content Box -->
        <div class="mt-8 pt-5">
            {{ $slot }}
        </div>
        
        <!-- Footer -->
        <footer class="mt-12 w-full flex flex-col items-center justify-between px-1 pb-8 pt-3 lg:px-8 xl:flex-row">
            <p class="mb-4 text-center text-sm font-medium text-gray-600 sm:!mb-0 md:text-lg">
                <span class="mb-4 text-center text-sm text-gray-600 sm:!mb-0 md:text-base">
                    © <script>document.write(new Date().getFullYear())</script> Gudang App. All Rights Reserved.
                </span>
            </p>
        </footer>
    </main>
    
    @stack('page-js')
    
    <!-- AlpineJS for basic toggles (if needed) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Chatbot Toggle Logic
        function toggleChatbot() {
            const chatbotWindow = document.getElementById('chatbot-window');
            chatbotWindow.classList.toggle('hidden');
            chatbotWindow.classList.toggle('flex');
            if(!chatbotWindow.classList.contains('hidden')){
                document.getElementById('chat-input').focus();
            }
        }

        // Chatbot AJAX Logic
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const chatMessages = document.getElementById('chat-messages');

            if(chatForm) {
                chatForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const message = chatInput.value.trim();
                    if(!message) return;

                    // 1. Tampilkan pesan user di UI
                    appendUserMessage(message);
                    chatInput.value = '';
                    
                    // 2. Tampilkan indikator typing AI
                    const typingIndicatorId = appendTypingIndicator();

                    try {
                        // 3. Kirim ke backend (ChatbotController) menggunakan relative path agar aman di Ngrok/Hosting
                        const response = await fetch('/chatbot/send', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ message: message })
                        });

                        const data = await response.json();
                        
                        // 4. Hapus indikator typing
                        document.getElementById(typingIndicatorId).remove();

                        if (data.success) {
                            appendAIMessage(data.message);
                        } else {
                            appendAIMessage("Maaf, terjadi kesalahan: " + data.message, true);
                        }
                    } catch (error) {
                        document.getElementById(typingIndicatorId).remove();
                        appendAIMessage("Gagal terhubung ke server. Silakan coba lagi.", true);
                    }
                });
            }

            function appendUserMessage(text) {
                const html = `
                <div class="flex gap-2 justify-end">
                    <div class="bg-brand-500 p-3 rounded-2xl rounded-tr-none shadow-sm text-sm text-white max-w-[85%]">
                        ${escapeHtml(text)}
                    </div>
                </div>`;
                chatMessages.insertAdjacentHTML('beforeend', html);
                scrollToBottom();
            }

            function appendAIMessage(text, isError = false) {
                const colorClass = isError ? 'text-red-500' : 'text-navy-700';
                
                // Format Markdown tebal (*) ke HTML kasar (opsional, bisa ditingkatkan)
                let formattedText = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                formattedText = formattedText.replace(/\n/g, '<br>');

                const html = `
                <div class="flex gap-2 justify-start">
                    <div class="w-8 h-8 rounded-full bg-brand-500 flex items-center justify-center shrink-0 mt-1">
                        <i class="ti ti-robot text-white text-sm"></i>
                    </div>
                    <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm text-sm ${colorClass} max-w-[85%] leading-relaxed">
                        ${formattedText}
                    </div>
                </div>`;
                chatMessages.insertAdjacentHTML('beforeend', html);
                scrollToBottom();
            }

            function appendTypingIndicator() {
                const id = 'typing-' + Date.now();
                const html = `
                <div id="${id}" class="flex gap-2 justify-start">
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center shrink-0 mt-1">
                        <i class="ti ti-robot text-gray-500 text-sm"></i>
                    </div>
                    <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm text-sm text-gray-500 flex items-center gap-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>`;
                chatMessages.insertAdjacentHTML('beforeend', html);
                scrollToBottom();
                return id;
            }

            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function escapeHtml(unsafe) {
                return unsafe
                     .replace(/&/g, "&amp;")
                     .replace(/</g, "&lt;")
                     .replace(/>/g, "&gt;")
                     .replace(/"/g, "&quot;")
                     .replace(/'/g, "&#039;");
            }
        });
    </script>

    <!-- Chatbot UI (Floating) -->
    <div class="fixed bottom-6 right-6 z-[100] flex flex-col items-end">
        <!-- Chat Window -->
        <div id="chatbot-window" class="hidden flex-col w-[350px] sm:w-[400px] h-[500px] bg-white rounded-2xl shadow-3xl overflow-hidden mb-4 border border-gray-100 transition-all duration-300 transform origin-bottom-right">
            <!-- Header -->
            <div class="bg-brand-500 p-4 flex items-center justify-between shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow">
                        <i class="ti ti-robot text-2xl text-brand-500"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-md leading-tight">Gudang AI</h3>
                        <p class="text-white/80 text-xs">Asisten Cerdas Anda</p>
                    </div>
                </div>
                <button onclick="toggleChatbot()" class="text-white/80 hover:text-white transition">
                    <i class="ti ti-x text-xl"></i>
                </button>
            </div>
            
            <!-- Chat Area -->
            <div id="chat-messages" class="flex-1 p-4 overflow-y-auto bg-gray-50 flex flex-col gap-3">
                <!-- Bot Welcome Message -->
                <div class="flex gap-2 justify-start">
                    <div class="w-8 h-8 rounded-full bg-brand-500 flex items-center justify-center shrink-0 mt-1">
                        <i class="ti ti-robot text-white text-sm"></i>
                    </div>
                    <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm text-sm text-navy-700 max-w-[85%]">
                        Halo! Saya asisten AI Gudang App. Ada yang bisa saya bantu terkait laporan stok atau riwayat barang hari ini?
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-3 bg-white border-t border-gray-100">
                <form id="chat-form" onsubmit="event.preventDefault();" class="flex items-center gap-2 relative">
                    <input type="text" id="chat-input" placeholder="Tanya tentang stok barang..." class="w-full bg-gray-50 border border-gray-200 rounded-full px-4 py-2.5 text-sm text-navy-700 outline-none focus:border-brand-500 focus:bg-white transition-all pr-12">
                    <button type="submit" class="absolute right-1 w-8 h-8 rounded-full bg-brand-500 flex items-center justify-center text-white hover:bg-brand-600 transition shadow">
                        <i class="ti ti-send text-sm"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Floating Button -->
        <button onclick="toggleChatbot()" class="w-14 h-14 bg-brand-500 rounded-full flex items-center justify-center text-white shadow-[0_10px_20px_rgba(67,24,255,0.4)] hover:-translate-y-1 hover:shadow-[0_15px_25px_rgba(67,24,255,0.5)] transition-all duration-300">
            <i class="ti ti-message-chatbot text-2xl"></i>
        </button>
    </div>
</body>
</html>
