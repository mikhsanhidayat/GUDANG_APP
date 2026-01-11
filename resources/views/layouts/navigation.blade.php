<div class="">

    <nav x-data="{ open: false }" class="shadow-2xl top-0 h-24 ml-[350PX] pr-48 bg-[#16335E] fixed w-full  z-50 ">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="flex justify-between h-16 pl-96">


                <!-- Settings Dropdown -->
                <div class="  w-full  sm:flex sm:items-center sm:ms-6 flex justify-end mt-5">
                    <x-dropdown align="right" width="100" class="">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-5 py-2 border text-3xl border-transparent   leading-4 font-medium rounded-md text-white focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="flex w-[350PX] flex-col  flex-shrink-0 shadow-2xl bg-[#16335E]  text-white"
        style=" height: 100vh; position: fixed; top: 0; left: 0;">

        <div>
            <div class="flex items-center p-6   h-24 border-b border-gray-700">
                
                <h1 class="text-2xl font-bold">GUDANG APP </h1>
            </div>
        </div>

        <div class="p-5 pt-14">
            {{-- <div class="flex items-center mb-6">
            <span class="text-xl font-semibold">Menu</span>
        </div> --}}

            <ul class="space-y-3 pt-4">
                {{-- DASHBOARD --}}
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center text-2xl font-bold p-3 rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="9" />
                            <rect x="14" y="3" width="7" height="5" />
                            <rect x="14" y="12" width="7" height="9" />
                            <rect x="3" y="16" width="7" height="5" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                {{-- PRODUK (Active State) --}}
                <li>
                    {{-- Logika Blade DIBIARKAN SAMA ({{ request()->is('products*') ? '...' : '' }}) --}}
                    <a href="{{ route('products.index') }}"
                        class="flex items-center p-3 rounded-lg text-2xl font-bold font-semibold transition duration-150 ease-in-out 
                          {{ request()->is('products*') ? 'bg-blue-600 text-white shadow-lg' : 'text-white hover:bg-blue-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s-8-4-8-12c0-4.42 3.58-8 8-8s8 3.58 8 8c0 8-8 12-8 12z" />
                            <polyline points="9 10 12 13 15 10" />
                        </svg>
                        Produk
                    </a>
                </li>

                {{-- BAHAN --}}
                <li>
                    <a href="{{ route('bahan.index') }}"
                        class="flex items-center p-3 text-2xl font-bold rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 12h-6m-6 0H3m6 0a3 3 0 010-6c-1.66 0-3 1.34-3 3s1.34 3 3 3zm6 0a3 3 0 010-6c-1.66 0-3 1.34-3 3s1.34 3 3 3z" />
                        </svg>
                        Bahan
                    </a>
                </li>

                {{-- USER --}}

                @can('viewAny', App\Models\User::class)
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="flex items-center p-3 text-2xl font-bold rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            User
                        </a>
                    </li>
                @endcan


                {{-- LAPORAN --}}
                @can('viewLaporan', App\Models\User::class)
                <li>
                    <a href="{{ route('laporan.index') }}"
                        class="flex items-center p-3 text-2xl font-bold rounded-lg text-white hover:bg-blue-600 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 20V10M18 20V4M6 20v-4" />
                        </svg>
                        Laporan
                    </a>
                </li>
                @endcan
            </ul>

            {{-- Bagian Dropdown Admin dan Sign Out (Dihilangkan, karena tidak ada di gambar) --}}
            {{-- <hr class="my-3 border-gray-700">
        <div class="dropdown">
            ...
        </div> --}}
        </div>
    </div>

    <main class="ms-sm-auto px-md-4" style="margin-left: 280px;">
        @yield('content')
    </main>

</div>
