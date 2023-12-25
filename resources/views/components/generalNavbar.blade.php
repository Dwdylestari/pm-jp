<nav class="navbar py-lg-3 navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('general.index') }}">PM. Jaya Perkasa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-4">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('general.auth.register') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('general.auth.login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>