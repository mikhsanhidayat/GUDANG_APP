<x-app-layout>
    <div class="mt-3 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-4 3xl:grid-cols-4">
        
        <!-- Total Produk -->
        <div class="relative flex flex-grow !flex-row flex-col items-center rounded-[20px] rounded-[20px] bg-white bg-clip-border shadow-3xl shadow-shadow-500 py-4 px-4">
            <div class="ml-[18px] flex h-[90px] w-auto flex-row items-center">
                <div class="rounded-full bg-lightPrimary p-3">
                    <span class="flex items-center text-brand-500">
                        <i class="ti ti-box text-3xl"></i>
                    </span>
                </div>
            </div>
            <div class="h-50 ml-4 flex w-auto flex-col justify-center">
                <p class="font-dm text-sm font-medium text-gray-600">Total Produk</p>
                <h4 class="text-xl font-bold text-navy-700">{{ $totalProducts }}</h4>
            </div>
        </div>

        <!-- Produk Hampir Habis -->
        <div class="relative flex flex-grow !flex-row flex-col items-center rounded-[20px] bg-white bg-clip-border shadow-3xl shadow-shadow-500 py-4 px-4">
            <div class="ml-[18px] flex h-[90px] w-auto flex-row items-center">
                <div class="rounded-full bg-red-50 p-3">
                    <span class="flex items-center text-horizonRed-500">
                        <i class="ti ti-alert-triangle text-3xl"></i>
                    </span>
                </div>
            </div>
            <div class="h-50 ml-4 flex w-auto flex-col justify-center">
                <p class="font-dm text-sm font-medium text-gray-600">Produk Hampir Habis</p>
                <h4 class="text-xl font-bold text-navy-700">{{ $lowStockProducts }}</h4>
            </div>
        </div>

        <!-- Total Bahan -->
        <div class="relative flex flex-grow !flex-row flex-col items-center rounded-[20px] bg-white bg-clip-border shadow-3xl shadow-shadow-500 py-4 px-4">
            <div class="ml-[18px] flex h-[90px] w-auto flex-row items-center">
                <div class="rounded-full bg-green-50 p-3">
                    <span class="flex items-center text-horizonGreen-500">
                        <i class="ti ti-stack text-3xl"></i>
                    </span>
                </div>
            </div>
            <div class="h-50 ml-4 flex w-auto flex-col justify-center">
                <p class="font-dm text-sm font-medium text-gray-600">Total Bahan</p>
                <h4 class="text-xl font-bold text-navy-700">{{ $totalBahan }}</h4>
            </div>
        </div>

        <!-- Bahan Hampir Habis -->
        <div class="relative flex flex-grow !flex-row flex-col items-center rounded-[20px] bg-white bg-clip-border shadow-3xl shadow-shadow-500 py-4 px-4">
            <div class="ml-[18px] flex h-[90px] w-auto flex-row items-center">
                <div class="rounded-full bg-orange-50 p-3">
                    <span class="flex items-center text-horizonOrange-500">
                        <i class="ti ti-alert-circle text-3xl"></i>
                    </span>
                </div>
            </div>
            <div class="h-50 ml-4 flex w-auto flex-col justify-center">
                <p class="font-dm text-sm font-medium text-gray-600">Bahan Hampir Habis</p>
                <h4 class="text-xl font-bold text-navy-700">{{ $lowStockBahan }}</h4>
            </div>
        </div>
    </div>

    <!-- Lists -->
    <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
        <!-- Produk Hampir Habis List -->
        <div class="horizon-card w-full p-4 h-full">
            <div class="relative flex items-center justify-between pt-4 pb-2 px-4">
                <div class="text-xl font-bold text-navy-700 flex items-center gap-2">
                    <i class="ti ti-alert-triangle text-horizonRed-500"></i> Produk Hampir Habis
                </div>
            </div>
            <div class="px-4 mt-4">
                <ul class="space-y-4">
                    @forelse($lowStockProductList as $product)
                        <li class="flex items-center justify-between pb-3 border-b border-gray-100 last:border-0">
                            <div>
                                <p class="text-base font-bold text-navy-700">{{ $product->nama_produk }}</p>
                                <p class="text-sm font-medium text-gray-600">Kode: {{ $product->kode_produk }} | Warna: {{ $product->warna }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-horizonRed-500">Stok: {{ $product->stok_tersedia }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500 italic py-4 text-center">Stok produk terpantau aman.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Bahan Hampir Habis List -->
        <div class="horizon-card w-full p-4 h-full">
            <div class="relative flex items-center justify-between pt-4 pb-2 px-4">
                <div class="text-xl font-bold text-navy-700 flex items-center gap-2">
                    <i class="ti ti-alert-circle text-horizonOrange-500"></i> Bahan Hampir Habis
                </div>
            </div>
            <div class="px-4 mt-4">
                <ul class="space-y-4">
                    @forelse($lowStockBahanList as $bahan)
                        <li class="flex items-center justify-between pb-3 border-b border-gray-100 last:border-0">
                            <div>
                                <p class="text-base font-bold text-navy-700">{{ $bahan->nama_bahan }}</p>
                                <p class="text-sm font-medium text-gray-600">Kode: {{ $bahan->kode_bahan }} | Warna: {{ $bahan->warna }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-horizonRed-500">Stok: {{ $bahan->stok_tersedia }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500 italic py-4 text-center">Stok bahan baku terpantau aman.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>