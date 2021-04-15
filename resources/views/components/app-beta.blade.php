<x-app-beta-main>
    <main class="w-full">
        <button @click="open = ! open" 
            class="hamburger items-center w-12
                    inline-flex justify-center
                    rounded-md text-white 
                    hover:text-gray-500 hover:bg-gray-200 
                    focus:outline-none focus:bg-gray-100 focus:text-gray-500 
                    transition duration-150 ease-in-out"
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
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>

                        <div class="settings">

                            <x-jet-dropdown width="48">
                                <x-slot name="trigger">
                                    <h3 class="trigger-header">{{ Auth::user()->name }}</h3>
                                </x-slot>

                                <x-slot name="content">

                                    <div class="border-t border-gray-100"></div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

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

                                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Profile') }}
                                        </x-jet-dropdown-link>

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
                    <img src="{{ asset('images/generic avatar.jpg') }}" 
                        class="h-40 w-40 rounded-full object-cover my-4" 
                        alt="avatar" 
                    />
                </div>
                <div class="links"> 
                    {{ $links }}
                </div>
            </div>
            {{ $games }} 
        </section>
    </main>
</x-app-beta-main>