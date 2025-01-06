<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @yield('link')
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

</head>
<body >
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white fw-bold" href="{{ route('user.home') }}">
                    <i class="bi bi-shop"></i>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto text-white">

                    @if (auth()->user()->role === "admin")
                        <li class="nav-item">
                            <a href="{{ route('admin.kategori.index') }}" class="text-white nav-link {{ request()->routeIs('admin.kategori.index') ? 'border-1 border-bottom border-white' : '' }} "><i class="bi bi-collection"></i> Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link text-white {{ request()->routeIs('admin.orders.index') ? 'border-1 border-bottom border-white' : '' }} "><i class="bi bi-shop-window"></i> Data Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders-history') }}" class="nav-link text-white {{ request()->routeIs('orders-history') ? 'border-1 border-bottom border-white' : '' }} "><i class="bi bi-clock-history"></i> Riwayat Pesanan</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('customer.cart.index') }}" class="nav-link text-white {{ request()->routeIs('customer.cart.index') ? 'border-1 border-bottom border-white' : '' }} "><i class="bi bi-cart3"></i> Keranjang Saya</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.order.index') }}" class="nav-link text-white {{ request()->routeIs('customer.order.index') ? 'border-1 border-bottom border-white':'' }}"><i class="bi bi-cart4"></i> Pesanan Saya</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders-history') }}" class="nav-link text-white {{ request()->routeIs('orders-history') ? 'border-1 border-bottom border-white' : '' }} "><i class="bi bi-clock-history"></i> Riwayat Pesanan</a>
                        </li>
                    
                        @endif
                    </ul>
                    
                    @endauth
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('user.login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('user.register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('user.register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="text-white nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    @if (auth()->user()->role === 'customer')
                                    <a href="{{ route('customer.profile.index') }}" class="dropdown-item">Profil saya</a>
                         
                                    @endif

                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
