<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a
                        href="https://www.google.com/maps/place/TITIPAN+ILAHI+POULTRY+SHOP/@1.1736087,109.0891879,15z/data=!4m2!3m1!1s0x0:0xe921fbbfa8b5356e?sa=X&ved=1t:2428&ictx=111"
                        target="_blank" class="text-white">Jl. Tunas Muda, RT.32/RW.10, Semparuk, Kec.
                        Semparuk</a></small>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="/" class="navbar-brand">
                <h1 class="text-primary display-6">Titipan Ilahi Poultry</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="/" class="nav-item nav-link {{ Request::Is('/') ? 'active' : '' }}">Home</a>
                    <a href="/produk" class="nav-item nav-link {{ Request::is('produk*') ? 'active' : '' }}">Produk</a>
                    {{-- <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a> --}}
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="cart.html" class="dropdown-item">Cart</a>
                            <a href="chackout.html" class="dropdown-item">Chackout</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div> --}}
                    {{-- <a href="contact.html" class="nav-item nav-link">Contact</a> --}}
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <!-- Tampilkan ini untuk admin -->
                            <div class="nav-item dropdown">
                                <a href="#" class="my-auto" data-bs-toggle="dropdown"><img class="rounded-circle me-2"
                                        src="{{ asset('storage/user/' . auth()->user()->foto) }}" alt="User Photo"
                                        style="width: 40px; height: 40px;">{{ auth()->user()->username }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-end m-0 rounded-0">
                                    <a href="/admin" class="btn border-secondary dropdown-item">Dashboard</a>
                                    <form action="/keluar" method="POST">
                                        @csrf
                                        <button type="submit" class="btn border-secondary dropdown-item">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        @elseif(Auth::user()->role === 'user')
                            <!-- Tampilkan ini untuk user -->
                            <a href="/keranjang" class="position-relative me-2 my-auto me-4">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                @if (array_sum(array_column(session('cart', []), 'quantity')) > 0)
                                    <span
                                        class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                        style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                        <span class="cart-item-count">
                                            {{ array_sum(array_column(session('cart', []), 'quantity')) }}
                                        </span>
                                    </span>
                                @endif
                            </a>
                            <div class="nav-item dropdown ">
                                <a href="#" class="my-auto" data-bs-toggle="dropdown"><img class="rounded-circle me-2"
                                        src="{{ asset('storage/user/' . auth()->user()->foto) }}" alt="User Photo"
                                        style="width: 40px; height: 40px;">{{ auth()->user()->username }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-end m-0 bg-secondary rounded-0">
                                    <a href="" class="btn border-secondary dropdown-item">Akun Saya</a>
                                    <a href="" class="btn border-secondary dropdown-item">Pesanan Saya</a>
                                    <form action="/keluar" method="POST">
                                        @csrf
                                        <button type="submit" class="btn border-secondary dropdown-item">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- Tampilkan ini untuk tamu (belum login) -->
                        <a href="/masuk">
                            <h5 class="btn border-secondary py-2 px-4 me-1 text-primary">Masuk</h5>
                        </a>
                        <a href="/daftar">
                            <h5 class="btn btn-primary border-secondary py-2 px-4 text-white">Daftar</h5>
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
