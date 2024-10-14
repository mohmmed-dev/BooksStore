<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                </div>
                <div class="hidden sm:flex justify-start items-center sm:items-center sm:ms-6 j">
                    <ul class="p-0 flex justify-start items-center">
                        @auth
                        <li class="mx-2">
                            <a href="{{route('view.cart')}}">
                                @if (auth()->user()->booksInCart()->count() > 0)
                                <livewire:CountShopping />
                                @else
                                <span>0</span>
                                @endif
                                {{__('Cart')}}
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                        @endauth
                        <li class="mx-2">
                            <a href="{{route('gallery.categories.index')}}">
                                {{__('Categories')}}
                                <i class="fas fa-list"></i>
                            </a>
                        </li>
                        <li class="mx-2">
                            <a href="{{route('gallery.publishers.index')}}">
                                {{__('Publishers')}}
                                <i class="fas fa-table"></i>
                            </a>
                        </li>
                        <li class="mx-2">
                            <a href="{{route('gallery.authors.index')}}">
                                {{__('Authors')}}
                                <i class="fas fa-pen"></i>
                            </a>
                        </li>
                        @auth
                        <li class="mx-2">
                            <a href="{{route('my.product')}}">
                                {{__('My Purchases')}}
                                <i class="fas fa-shopping-bag"></i>
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ms-6 justify-end">
                    @auth
                        <!-- Teams Dropdown -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="ms-3 relative">
                                <x-dropdown align="right" width="60">
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->currentTeam->name }}
                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>
                                            <!-- Team Settings -->
                                            <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                {{ __('Team Settings') }}
                                            </x-dropdown-link>
                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                <x-dropdown-link href="{{ route('teams.create') }}">
                                                    {{ __('Create New Team') }}
                                                </x-dropdown-link>
                                            @endcan
                                            <!-- Team Switcher -->
                                            @if (Auth::user()->allTeams()->count() > 1)
                                                <div class="border-t border-gray-200"></div>
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Switch Teams') }}
                                                </div>
                                                @foreach (Auth::user()->allTeams() as $team)
                                                    <x-switchable-team :team="$team" />
                                                @endforeach
                                            @endif
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endif
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Lang -->
                                        <a href="{{route('ar')}}" class="px-1 text-sm">{{__("AR")}}</a>/
                                        <a href="{{route('en')}}" class="px-1 text-sm">{{__("EN")}}</a>
                                    <!-- Account Management -->
                                    @can('update-books')
                                    <a href="{{route('admin')}}" class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Dashboard') }}
                                    </a>
                                    @endcan

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <div class="m-1">
                            <a href="{{ route('login') }}" class="py-2 px-2 bg-slate-900 text-white text-xs rounded-md">
                            {{ __('Login') }}
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('register') }}" class="py-2 px-2 border border-1 text-xs rounded-md hover:text-white hover:bg-slate-900 hover:border-none transition duration-700 ease-in-out ">
                                {{ __('Register') }}
                            </a>
                        </div>
                    @endauth
                </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
                    <ul class="p-0">
                        @auth
                        <li class="my-1 p-2">
                            <a href="{{route('view.cart')}}" class="block">
                                @if (auth()->user()->booksInCart()->count() > 0)
                                <i class="fas fa-shopping-cart mx-1"></i>
                                {{__('Cart')}}
                                <livewire:CountShopping />
                                @else
                                <span>0</span>
                                @endif
                            </a>
                        </li>
                        @endauth
                        <li class="my-1 p-2">
                            <a href="{{route('gallery.categories.index')}}" class="block">
                                <i class="fas fa-list mx-1"></i>
                                {{__('Categories')}}
                            </a>
                        </li>
                        <li class="my-1 p-2">
                            <a href="{{route('gallery.publishers.index')}}" class="block">
                                <i class="fas fa-table mx-1"></i>
                                {{__('Publishers')}}
                            </a>
                        </li>
                        <li class="my-1 p-2">
                            <a href="{{route('gallery.authors.index')}}" class="block">
                                <i class="fas fa-pen mx-1"></i>
                                {{__('Authors')}}
                            </a>
                        </li>
                        @auth
                        <li class="my-1 p-2">
                            <a href="{{route('my.product')}}" class="block">
                                <i class="fas fa-shopping-bag mx-1"></i>
                                {{__('My Purchases')}}
                            </a>
                        </li>
                        @endauth
                    </ul>
            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                        @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>
                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
