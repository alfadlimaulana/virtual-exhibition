<nav x-init="initState" @scroll.window="initState" x-data="navState" id="main-nav" :class="navTheme" class="sticky top-0 left-0 right-0 z-50 bg-gray-200 group [&.nav-dark]:bg-gray-500">
    <div id="nav" class="container sticky top-0 left-0 w-full py-2 mx-auto">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button @click="toggleMobileNav()" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 border border-gray-500 group-[.nav-dark]:text-white active:text-white active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">{{ __('Open main menu') }}</span>
                    <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center content-center justify-center flex-1 sm:items-stretch sm:justify-between">
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4 text-gray-600 group-[.nav-dark]:text-white">
                        <a href=""
                            class="px-3 py-2 text-base font-medium transition duration-300 ease-out hover:text-gray-800">
                            Subscribe
                        </a>
                        <a href=""
                            class="px-3 py-2 text-base font-medium transition duration-300 ease-out hover:text-gray-800">
                            Portfolio
                        </a>
                        <a href=""
                            class="px-3 py-2 text-base font-medium transition duration-300 ease-out hover:text-gray-800">
                            Tema
                        </a>
                        <a href=""
                            class="px-3 py-2 text-base font-medium transition duration-300 ease-out hover:text-gray-800">
                            Fitur
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <div class="relative ml-3" x-data="{ isUserMenuOpen: false }">
                    <div class="flex flex-row gap-2">
                        @guest
                        <x-button-a href="{{ route('login') }}"
                            class="invisible px-6 tracking-normal text-white capitalize transition-colors duration-200 transform !rounded-full bg-gray-500 group-[.nav-dark]:border border-white hover:bg-gray-600 md:visible">
                            <span class="mx-1">{{ __('Login') }}</span>
                        </x-button-a>
                        @else
                        <button @click="isUserMenuOpen = !isUserMenuOpen" @keydown.escape="isUserMenuOpen = false"
                            type="button"
                            class="flex text-sm transition duration-300 ease-out bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-offset-cyan-800 focus:ring-white"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">{{ __('Open main menu') }}</span>
                            <img class="w-10 h-10 border border-transparent rounded-full hover:border-cyan-600"
                                src="{{ asset(auth()->user()->avatar) }}" alt="{{ asset(auth()->user()->name) }}">
                        </button>
                        @endguest
                    </div>

                    @auth
                    <div x-show="isUserMenuOpen" @click.away="isUserMenuOpen = false" x-transition
                        class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        @can('view_backend')
                            <a href='' role="menuitem"
                                class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-500 hover:text-white">
                                <i class="fas fa-tachometer-alt fa-fw"></i>&nbsp;Dashboard Kurator
                            </a>
                        @endif
                            <a href=""
                                class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-500 hover:text-white"
                                role="menuitem">
                                <i class="fas fa-user fa-fw"></i>&nbsp;Dashboard Pelukis
                            </a>
                            <a href=""
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-500 hover:text-white"
                                role="menuitem">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="absolute z-10 w-full p-1 sm:hidden" id="mobile-menu" x-show="showMobileNav"
        @click.away="showMobileNav = false" x-transition>
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
            <a href=""
                class="block px-3 py-2 text-base font-medium text-gray-500 rounded-md">
                Paket
            </a>
            <a href=""
                class="block px-3 py-2 text-base font-medium text-gray-500 rounded-md">
                Portfolio
            </a>
            <a href=""
                class="block px-3 py-2 text-base font-medium text-gray-500 rounded-md">
                Tema
            </a>
            <a href=""
                class="block px-3 py-2 text-base font-medium text-gray-500 rounded-md">
                Fitur
            </a>
    
            @guest
                <hr>
                <a href="{{ route('login') }}"
                    class="block px-3 py-2 mt-2 text-base font-medium rounded-md text-gray-500 bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span class="mx-1">{{ __('Login') }}</span>
                </a>
            @endauth
        </div>
    </div>
</nav>

@push('after-javascript')
    <script>
        // const mainNav = document.getElementById("main-nav");
        // const nav = document.getElementById("nav");

        // document.addEventListener("scroll", () => {
        //     if (window.pageYOffset > 0) {
        //         nav.classList.add("nav-dark");
        //         nav.classList.remove("nav-light");

        //         mainNav.classList.add('bg-gray-500');
        //     } else {
        //         nav.classList.remove("nav-dark");
        //         nav.classList.add("nav-light");

        //         mainNav.classList.remove('bg-gray-500');
        //     }
        // });
    </script>
@endpush
