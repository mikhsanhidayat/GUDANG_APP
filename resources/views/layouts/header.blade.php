<nav class="sticky top-4 z-40 flex flex-row flex-wrap items-center justify-between rounded-xl bg-white/10 p-2 backdrop-blur-xl transition-all">
    <div class="ml-[6px]">
        <div class="h-6 w-[224px] pt-1">
            <a class="text-sm font-normal text-navy-700 hover:underline" href="javascript:void(0);">Pages <span class="mx-1 text-sm text-navy-700 hover:text-navy-700"> / </span></a>
            <a class="text-sm font-normal capitalize text-navy-700 hover:underline" href="javascript:void(0);">
                {{ request()->segment(1) ?: 'Dashboard' }}
            </a>
        </div>
        <p class="shrink text-[33px] capitalize text-navy-700 font-bold">
            <a class="font-bold capitalize hover:text-navy-700" href="javascript:void(0);">
                {{ request()->segment(1) ?: 'Dashboard' }}
            </a>
        </p>
    </div>

    <div class="relative mt-[3px] flex h-[61px] w-[355px] flex-grow items-center justify-around gap-2 rounded-full bg-white px-2 py-2 shadow-xl shadow-shadow-500 md:w-[365px] md:flex-grow-0 md:gap-1 xl:w-[365px] xl:gap-2">
        <div class="flex h-full items-center rounded-full bg-lightPrimary text-navy-700 xl:w-[225px]">
            <p class="pl-3 pr-2 text-xl">
                <i class="ti ti-search h-4 w-4 text-gray-400"></i>
            </p>
            <input type="text" placeholder="Search..." class="block h-full w-full rounded-full bg-lightPrimary text-sm font-medium text-navy-700 outline-none placeholder:!text-gray-400 sm:w-fit border-none focus:ring-0" />
        </div>
        <span class="flex cursor-pointer text-xl text-gray-600 xl:hidden" onclick="toggleSidebar()">
            <i class="ti ti-menu-2 h-5 w-5"></i>
        </span>
        <div class="cursor-pointer text-gray-600">
            <i class="ti ti-bell h-4 w-4"></i>
        </div>
        <div class="cursor-pointer text-gray-600">
            <i class="ti ti-moon h-4 w-4"></i>
        </div>
        <!-- Profile Dropdown (AlpineJS for simplicity) -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center outline-none">
                <img class="h-10 w-10 rounded-full border-2 border-white object-cover" src="{{ asset('horizon_assets/img/avatars/avatar4.png') }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=4318FF&color=fff'" alt="User Avatar" />
            </button>
            <div x-show="open" @click.away="open = false" style="display: none;" class="absolute right-0 top-12 z-50 w-56 rounded-xl bg-white shadow-xl shadow-shadow-500 flex flex-col py-3 px-3">
                <div class="flex items-center gap-3 border-b border-gray-200 px-3 pb-3">
                    <img class="h-10 w-10 rounded-full border border-gray-200" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=4318FF&color=fff" alt="" />
                    <div class="flex flex-col">
                        <p class="text-sm font-bold text-navy-700">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'admin@admin.com' }}</p>
                    </div>
                </div>
                <div class="flex flex-col pt-2">
                    <a href="{{ route('profile.edit') }}" class="px-3 py-2 text-sm font-medium text-navy-700 hover:bg-gray-100 rounded-lg transition-colors">Profile Settings</a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="mt-1 px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-50 rounded-lg transition-colors block">
                            Log Out
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
