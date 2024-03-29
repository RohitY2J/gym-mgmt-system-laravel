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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                                    </ul>
                                </div>
                            </div>
                        </nav>

                        <a href="{{route('admin.dashboard')}}"
                            class="list-group-item border-end-0 d-inline-block text-truncate border-bottom-0 pt-4"
                            data-bs-parent="#sidebar">
                            <!-- <i class="bi bi-bootstrap">
                            </i> -->
                            <span>Dashboard</span>
                        </a>
                        <a href="" data-bs-toggle="collapse"
                            class="list-group-item d-inline-block text-truncate border-0 pt-3" data-bs-parent="#sidebar"
                            data-bs-target="#category-collapse" aria-expanded="true" aria-controls="category-collapse">
                            Category
                        </a>
                        <div class="collapse" id="category-collapse" style="margin-left: 15px;">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small mb-0">
                                <li><a href="{{route('admin.category')}}" class="list-group-item 
                                            d-inline-block 
                                            text-truncate 
                                            border-0 
                                            custom-padding">Add Category</a>
                                </li>
                            </ul>
                        </div>
                        <a href="" data-bs-toggle="collapse"
                            class="list-group-item d-inline-block text-truncate border-0 pt-3" data-bs-parent="#sidebar"
                            data-bs-target="#package-type-collapse" aria-expanded="true"
                            aria-controls="package-type-collapse">
                            Package Type
                        </a>
                        <div class="collapse" id="package-type-collapse" style="margin-left: 15px;">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small mb-0">
                                <li><a href="{{route('admin.package_type')}}" class="list-group-item 
                                            d-inline-block 
                                            text-truncate 
                                            border-0 
                                            custom-padding">Add Package Type</a>
                                </li>
                            </ul>
                        </div>
                        <a href="{{route('admin.bookings')}}" class="list-group-item d-inline-block text-truncate border-0 pt-3"
                            data-bs-parent="#sidebar">
                            <!-- <i class="bi bi-bootstrap">
                            </i> -->
                            <span>Booking History</span>
                        </a>
                        <a href="{{route('admin.report')}}" class="list-group-item d-inline-block text-truncate border-0 pt-3"
                            data-bs-parent="#sidebar">
                            Report
                        </a>

                    </div>
                </div>
            </div>
            <main class="col padding-0">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container dashboard-nav">
                        <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
                            class="p-1 text-decoration-none"><i class="bi bi-list bi-lg h3 py-2 p-1"></i>
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
                                //['text' => 'Home', 'url' => 'welcome.home'],
                                //['text' => 'Contact', 'url' => 'welcome.contact'],
                                //['text' => 'About', 'url' => 'about'],
                                //['text' => 'Booking History', 'url' => 'booking']
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