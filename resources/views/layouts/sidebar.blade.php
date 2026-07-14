<aside id="sidebar" class="sidebar fixed z-50 flex h-full w-[290px] flex-col bg-white pb-10 transition-all duration-300 xl:translate-x-0 -translate-x-full">
    <button onclick="toggleSidebar()" class="absolute top-4 right-4 xl:hidden block p-2 text-gray-600">
        <i class="ti ti-x text-2xl"></i>
    </button>
    
    <div class="mt-[50px] flex items-center justify-center w-full">
        <div class="flex items-center gap-3">
            <div class="rounded-xl bg-brand-500 p-2 text-white flex items-center justify-center shadow-lg shadow-brand-500/40">
                <i class="ti ti-box-seam text-2xl"></i>
            </div>
            <div class="font-poppins text-[24px] font-bold uppercase text-navy-700 tracking-wide mt-1">
                Gudang<span class="font-medium text-brand-500">App</span>
            </div>
        </div>
    </div>
    <div class="mt-8 mb-7 h-px bg-gray-200 mx-8"></div>

    <ul class="mb-auto pt-1 w-full space-y-2">
        <!-- Dashboard -->
        <li class="w-full">
            <a href="{{ route('dashboard') }}" class="relative mb-3 flex hover:cursor-pointer {{ request()->routeIs('dashboard') ? 'text-brand-500 font-bold' : 'text-gray-600 font-medium' }}">
                <div class="my-[3px] flex cursor-pointer items-center px-8">
                    <span class="{{ request()->routeIs('dashboard') ? 'text-brand-500' : 'text-gray-600' }}">
                        <i class="ti ti-smart-home text-xl"></i>
                    </span>
                    <p class="leading-1 ml-4 flex">Dashboard</p>
                </div>
                @if(request()->routeIs('dashboard'))
                    <div class="absolute right-0 top-px h-9 w-1 rounded-lg bg-brand-500"></div>
                @endif
            </a>
        </li>

        <li class="px-8 mt-6 mb-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Master Data</li>
        
        <!-- Data Barang -->
        <li class="w-full">
            <a href="{{ route('products.index') }}" class="relative mb-3 flex hover:cursor-pointer {{ request()->routeIs('products.*') ? 'text-brand-500 font-bold' : 'text-gray-600 font-medium' }}">
                <div class="my-[3px] flex cursor-pointer items-center px-8">
                    <span class="{{ request()->routeIs('products.*') ? 'text-brand-500' : 'text-gray-600' }}">
                        <i class="ti ti-box text-xl"></i>
                    </span>
                    <p class="leading-1 ml-4 flex">Data Produk</p>
                </div>
                @if(request()->routeIs('products.*'))
                    <div class="absolute right-0 top-px h-9 w-1 rounded-lg bg-brand-500"></div>
                @endif
            </a>
        </li>

        <!-- Data Bahan -->
        <li class="w-full">
            <a href="{{ route('bahan.index') }}" class="relative mb-3 flex hover:cursor-pointer {{ request()->routeIs('bahan.*') ? 'text-brand-500 font-bold' : 'text-gray-600 font-medium' }}">
                <div class="my-[3px] flex cursor-pointer items-center px-8">
                    <span class="{{ request()->routeIs('bahan.*') ? 'text-brand-500' : 'text-gray-600' }}">
                        <i class="ti ti-stack text-xl"></i>
                    </span>
                    <p class="leading-1 ml-4 flex">Data Bahan</p>
                </div>
                @if(request()->routeIs('bahan.*'))
                    <div class="absolute right-0 top-px h-9 w-1 rounded-lg bg-brand-500"></div>
                @endif
            </a>
        </li>

        <li class="px-8 mt-6 mb-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Laporan</li>
        
        <!-- Laporan Barang -->
        <li class="w-full">
            <a href="{{ route('laporan.produk') }}" class="relative mb-3 flex hover:cursor-pointer {{ request()->routeIs('laporan.produk') ? 'text-brand-500 font-bold' : 'text-gray-600 font-medium' }}">
                <div class="my-[3px] flex cursor-pointer items-center px-8">
                    <span class="{{ request()->routeIs('laporan.produk') ? 'text-brand-500' : 'text-gray-600' }}">
                        <i class="ti ti-file-report text-xl"></i>
                    </span>
                    <p class="leading-1 ml-4 flex">Laporan Produk</p>
                </div>
                @if(request()->routeIs('laporan.produk'))
                    <div class="absolute right-0 top-px h-9 w-1 rounded-lg bg-brand-500"></div>
                @endif
            </a>
        </li>

        <!-- Laporan Bahan -->
        <li class="w-full">
            <a href="{{ route('laporan.bahan') }}" class="relative mb-3 flex hover:cursor-pointer {{ request()->routeIs('laporan.bahan') ? 'text-brand-500 font-bold' : 'text-gray-600 font-medium' }}">
                <div class="my-[3px] flex cursor-pointer items-center px-8">
                    <span class="{{ request()->routeIs('laporan.bahan') ? 'text-brand-500' : 'text-gray-600' }}">
                        <i class="ti ti-file-description text-xl"></i>
                    </span>
                    <p class="leading-1 ml-4 flex">Laporan Bahan</p>
                </div>
                @if(request()->routeIs('laporan.bahan'))
                    <div class="absolute right-0 top-px h-9 w-1 rounded-lg bg-brand-500"></div>
                @endif
            </a>
        </li>

        <li class="px-8 mt-6 mb-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Pengaturan</li>
        
        <!-- User -->
        <li class="w-full">
            <a href="{{ route('users.index') }}" class="relative mb-3 flex hover:cursor-pointer {{ request()->routeIs('users.*') ? 'text-brand-500 font-bold' : 'text-gray-600 font-medium' }}">
                <div class="my-[3px] flex cursor-pointer items-center px-8">
                    <span class="{{ request()->routeIs('users.*') ? 'text-brand-500' : 'text-gray-600' }}">
                        <i class="ti ti-users text-xl"></i>
                    </span>
                    <p class="leading-1 ml-4 flex">Manajemen User</p>
                </div>
                @if(request()->routeIs('users.*'))
                    <div class="absolute right-0 top-px h-9 w-1 rounded-lg bg-brand-500"></div>
                @endif
            </a>
        </li>
    </ul>

    <!-- Free Horizon UI Logo / illustration at the bottom -->
    <div class="flex justify-center mt-auto pb-6">
        <div class="w-[200px] h-32 rounded-2xl bg-gradient-to-br from-[#868CFF] to-[#4318FF] flex flex-col items-center justify-center text-white text-center p-4">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mb-2">
                <i class="ti ti-diamond text-xl"></i>
            </div>
            <h5 class="text-sm font-bold">Horizon UI</h5>
            <p class="text-xs text-white/80">Tailwind Theme</p>
        </div>
    </div>
</aside>
