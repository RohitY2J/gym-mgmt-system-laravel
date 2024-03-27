<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto px-0">
                <div id="sidebar" class="collapse collapse-horizontal show border-end">
                    <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                        <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">
                                

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                
                            </ul>
                        </div>
                    </div>
                </nav>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-bootstrap"></i> <span>Item</span> </a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-film"></i> <span>Item</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-heart"></i> <span>Item</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-bricks"></i> <span>Item</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-clock"></i> <span>Item</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-archive"></i> <span>Item</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-gear"></i> <span>Item</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-calendar"></i> <span>Item</span></a>
                        <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate"
                            data-bs-parent="#sidebar"><i class="bi bi-envelope"></i> <span>Item</span></a>
                    </div>
                </div>
            </div>
            <main class="col padding-0">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container dashboard-nav">
                        <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
                            class="p-1 text-decoration-none"><i class="bi bi-list bi-lg py-2 p-1"></i>
                            </a>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">
                                @php
                                $menuItems = [
                                ['text' => 'Home', 'url' => 'welcome.home'],
                                ['text' => 'Contact', 'url' => 'welcome.contact'],
                                //['text' => 'About', 'url' => 'about'],
                                ['text' => 'Booking History', 'url' => 'booking']
                                ];
                                @endphp


                                @foreach ($menuItems as $item)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route($item['url']) }}">{{ $item['text'] }}
                                    </a>
                                </li>
                                @endforeach

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @endif

                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>

                <main class="py-4">
                    @yield('content')
                </main>
            </main>
        </div>
    </div>
</body>

</html>