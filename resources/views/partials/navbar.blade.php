<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Dashboard Berita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}"
                        href="/">Dashboard</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('category*') ? 'active' : '' }}" href="/category">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('posts*') ? 'active' : '' }}" href="/posts">Berita</a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Halo, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="/register">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
