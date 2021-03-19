<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lipa Utilities') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div x-data="{ success_notif: true, failure_notif: true, open: false }" class="min-h-screen">
            <!-- Page Content -->
            <main class="w-full">
                <button @click="open = ! open" 
                    class="hamburger items-center w-12
                            inline-flex justify-center
                            p-2 rounded-md text-white 
                            hover:text-gray-500 hover:bg-gray-200 
                            focus:outline-none focus:bg-gray-100 focus:text-gray-500 
                            transition duration-150 ease-in-out
                            absolute top-4 left-4"
                >
                    <svg class="h-8 w-12" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div x-show="open" id="dashboard-upper-section-nav-drawer" class="dashboard-upper-section-nav-drawer">
                    <div class="user">
                        @auth
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                {{ dd('Has profile photo') }}
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>

                                <div class="settings">

                                    <x-jet-dropdown width="48">
                                        <x-slot name="trigger">
                                            <h3 class="trigger-header">{{ Auth::user()->name }}</h3>
                                        </x-slot>

                                        <x-slot name="content">

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                    {{ __('Logout') }}
                                                </x-jet-dropdown-link>
                                            </form>

                                        </x-slot>

                                    </x-jet-dropdown>

                                </div>
                            @else
                                <img src="{{ asset('images/generic avatar.jpg') }}" alt="{{ Auth::user()->name }}" />
                                <div class="sm:flex sm:items-center sm:ml-6">

                                    <!-- Settings Dropdown -->
                                    <div class="settings">

                                        <x-jet-dropdown width="48">
                                            <x-slot name="trigger">
                                                <h3 class="trigger-header">{{ Auth::user()->name }}</h3>
                                            </x-slot>

                                            <x-slot name="content">

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                        {{ __('Logout') }}
                                                    </x-jet-dropdown-link>
                                                </form>

                                            </x-slot>

                                        </x-jet-dropdown>

                                    </div>

                                </div>
                            @endif
                        @endauth

                        @guest
                            <img src="{{ asset('images/generic avatar.jpg') }}" alt="avatar"/>
                        @endguest
                    </div>
                    <div class="links"> 
                        {{ $links }}
                    </div>
                </div>
                <section class="glass">
                    <div class="dashboard-upper-section">
                        <div class="user">
                            @auth
                                <!-- <img src="{{-- asset('images/generic avatar.jpg') --}}" class="avatar mb-4" alt="" /> -->
                                <!-- <h3>John Doe</h3> -->
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <!-- <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out"> -->
                                        <img class="h-40 w-40 rounded-full object-cover" 
                                            src="{{ Auth::user()->profile_photo_url }}" 
                                            alt="{{ Auth::user()->name }}" 
                                        />
                                        <!-- <h3>{{-- Auth::user()->name --}}</h3> -->
                                        <div class="ml-3 relative">

                                            <x-jet-dropdown width="48">
                                                <x-slot name="trigger">
                                                    <h3 class="trigger-header">{{ Auth::user()->name }}</h3>
                                                </x-slot>

                                                <x-slot name="content">

                                                    <div class="border-t border-gray-100"></div>

                                                    <!-- Authentication -->
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                            {{ __('Logout') }}
                                                        </x-jet-dropdown-link>
                                                    </form>

                                                </x-slot>

                                            </x-jet-dropdown>

                                        </div>
                                    <!-- </button> -->
                                @else
                                    <!-- <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"> -->
                                            <img class="h-40 w-40 rounded-full object-cover my-4" 
                                                src="{{ asset('images/generic avatar.jpg') }}" 
                                                alt="{{ Auth::user()->name }}" 
                                            />
                                            <!-- <h3>{{-- Auth::user()->name --}}</h3> -->

                                            <div class="ml-3 relative">

                                                <x-jet-dropdown width="48">
                                                    <x-slot name="trigger">
                                                        <h3 class="trigger-header">
                                                            <div class="flex justify-center">
                                                                <span>
                                                                    {{ Auth::user()->name }}
                                                                </span>
                                                                <span class="py-1">
                                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </h3>
                                                    </x-slot>

                                                    <x-slot name="content">

                                                        <div class="border-t border-gray-100"></div>

                                                        <!-- Authentication -->
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf

                                                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault();
                                                                            this.closest('form').submit();">
                                                                {{ __('Logout') }}
                                                            </x-jet-dropdown-link>
                                                        </form>

                                                    </x-slot>

                                                </x-jet-dropdown>

                                            </div>

                                            <!-- <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span> -->
                                @endif
                            @endauth

                            @guest
                                <img src="{{ asset('images/generic avatar.jpg') }}" 
                                    class="h-40 w-40 rounded-full object-cover my-4" 
                                    alt="avatar" 
                                />
                            @endguest
                        </div>
                        <div class="links"> 
                            {{ $links }}
                        </div>
                    </div>
                    {{ $games }} 
                </section>
            </main>
            <!-- <div class="circle1"></div>
            <div class="circle2"></div> -->

        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>
