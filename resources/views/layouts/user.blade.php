<!DOCTYPE html>
@php
    use App\Models\Cart;
@endphp
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ auth()->user()->isMerchant() ? 'Merchant' : 'Customer' }} - @yield('title', 'Dashboard')</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background: url('{{ asset('images/background.jpg') }}')">
    <!-- Navbar atau Sidebar (opsional) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container">
            <a class="navbar-brand text-capitalize" href="#">Marketplace Katering - {{ auth()->user()->role }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header bg-success">
                    <h5 class="offcanvas-title text-capitalize" id="offcanvasNavbarLabel">{{ auth()->user()->role }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body bg-success">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        @if (auth()->user()->isCustomer() && request()->routeIs('customer.dashboard'))
                            <form class="d-flex mx-auto row-cols-auto" role="search"
                                action="{{ route('customer.dashboard') }}" method="GET">
                                <input class="form-control me-2" type="search" name="search"
                                    placeholder="cari menu, merchant, dll" aria-label="Search"
                                    value="{{ request('search') }}">
                                <button class="btn btn-outline-light" type="submit"><i
                                        class="bi bi-search"></i></button>
                            </form>
                        @endif


                        <li class="nav-item">
                            <a class="nav-link {{ (auth()->user()->isCustomer() ? (request()->routeIs('customer.dashboard') ? 'active' : '') : request()->routeIs('merchant.dashboard')) ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">Beranda</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}"
                                href="{{ route('orders.index') }}">
                                Pesanan
                            </a>
                        </li>

                        @if (auth()->user()->isCustomer())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('customer.cart.index') ? 'active' : '' }}"
                                    href="{{ route('customer.cart.index') }}">
                                    <i class="bi bi-cart3"></i>
                                    <span>{{ Cart::count() }}</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->isMerchant())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('merchant.menus.index') ? 'active' : '' }}"
                                    href="{{ route('merchant.menus.index') }}">
                                    Kelola Menu
                                </a>
                            </li>
                        @endif

                        <!-- Dropdown untuk Profile dan Logout -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu bg-success">
                                <li>
                                    <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                                        href="{{ route('profile.edit') }}">
                                        Profil
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand text-capitalize" href="#">Marketplace Katering -
                {{ auth()->user()->role }}</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">

                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Halaman -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Tambahkan link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>
