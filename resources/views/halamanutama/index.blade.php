<x-app-layout>
    <div class="min-h-screen bg-[#2A446C]">
        <div class="max-w-7xl ml-[470px] pt-36   px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow p-4 h-32 flex flex-col justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-600 p-1.5 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-gray-800">Total Produk</h2>
                    </div>
                    <p class="text-4xl font-bold text-black">{{ $totalProducts }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 h-32 flex flex-col justify-between">
                    <h2 class="text-sm font-bold text-gray-800">Produk Hampir Habis</h2>
                    <p class="text-4xl font-bold text-black">{{ $lowStockProducts }}</p>
                </div>

                <div class="bg-white rounded-xl shadow p-4 h-32 flex flex-col justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-600 p-1.5 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-gray-800">Total Bahan</h2>
                    </div>
                    <p class="text-4xl font-bold text-black">{{ $totalBahan }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 h-32 flex flex-col justify-between">
                    <h2 class="text-sm font-bold text-gray-800">Bahan Hampir Habis</h2>
                    <p class="text-4xl font-bold text-black">{{ $lowStockBahan }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 min-h-[400px]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-yellow-500 text-2xl">⚠️</span>
                            <h3 class="font-bold text-gray-800">Produk Hampir Habis</h3>
                        </div>
                        <ul class="space-y-4 ml-6 text-gray-700">
                            @foreach($lowStockProductList as $product)
                                <li class="border-b pb-2">
                                    <div class="font-medium text-lg">{{ $product->nama_produk }}</div>
                                    <div class="text-sm text-gray-600">Kode: {{ $product->kode_produk }}</div>
                                    <div class="text-sm text-gray-600">Warna: {{ $product->warna }}</div>
                                    @if($product->logo)
                                        <div class="text-sm text-gray-600">Logo: {{ $product->logo }}</div>
                                    @endif
                                    <div class="text-sm font-semibold text-red-600">Stok: {{ $product->stok_tersedia }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-yellow-500 text-2xl">⚠️</span>
                            <h3 class="font-bold text-gray-800">Bahan Hampir Habis</h3>
                        </div>
                        <ul class="space-y-4 ml-6 text-gray-700">
                            @foreach($lowStockBahanList as $bahan)
                                <li class="border-b pb-2">
                                    <div class="font-medium text-lg">{{ $bahan->nama_bahan }}</div>
                                    <div class="text-sm text-gray-600">Kode: {{ $bahan->kode_bahan }}</div>
                                    <div class="text-sm text-gray-600">Warna: {{ $bahan->warna }}</div>
                                    <div class="text-sm font-semibold text-red-600">Stok: {{ $bahan->stok_tersedia }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

               
            </div>

        </div>
    </div>
</x-app-layout>