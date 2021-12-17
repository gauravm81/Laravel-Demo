<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	@include('shared.components.scripts-head')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
   @include('shared.components.scripts-body-top')
@include('shared.components.all-page-loading')


<div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">

    @guest
    @else
        @include('shared.sidebar-desktop')
    @endguest

    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        @guest
        @else
        <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
            <button @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>
            <div class="flex-1 flex justify-between">
                <div class="flex-1 flex"></div>
                <div class="ml-4 flex items-center md:ml-6">
                   
                    <button class="p-1 ml-3 text-gray-400 rounded-full hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:shadow-outline focus:text-gray-500">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <div @click.away="open = false" class="ml-3 py-3 border-l border-cool-gray-200 px-3 hover:bg-cool-gray-100 focus:bg-cool-gray-200 relative transition ease-in-out duration-150" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" class="max-w-xs flex items-center text-sm focus:outline-none">
                                @if ( Auth::user()->avatar )
                                    <img src="/storage/{{ Auth::user()->getThumbnailPath() }}" class="h-10 w-10 rounded-full">
                                @else
                                    <div class="h-10 w-10 overflow-hidden rounded-full bg-gray-50 border border-gray-200">
                                        <svg class="h-auto w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                @endif
                                <div class="pl-2 pr-10 text-left text-sm leading-4 text-cool-gray-500 transition ease-in-out duration-150 relative">
                                    <span class="text-cool-gray-800 font-semibold">Hi {{Auth::user()->first_name}}</span><br>My Account
                                    <svg class="h-5 w-5 absolute right-0 top-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                            <div class="py-1 rounded-md bg-white shadow-xs">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150">Sign out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endguest
        <main class="flex-1 relative overflow-y-auto py-6 focus:outline-none overflow-hidden max-w-full w-full bg-white" tabindex="0" x-data x-init="$el.focus()">


            @yield('content')
        </main>
    </div>
</div>

@yield('modals')
@include('shared.components.alert.modal.success')
@include('shared.components.alert.modal.error')
@include('shared.components.alert.modal.warning')
@include('shared.components.alert.modal.confirm-delete')
@include('shared.components.alert.modal.confirm')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script src="{{ asset('js/app.js') }}"></script>
	
    @if (Auth::check() && Auth::user()->isAdmin() )
    <script src="{{ asset('js/admin.js') }}"></script>
    @endif

    @stack('scripts')
	@include('shared.components.scripts-footer')
</body>
</html>
