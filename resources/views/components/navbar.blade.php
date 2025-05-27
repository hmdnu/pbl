<nav class="navbar navbar-expand-lg bg-light border-bottom shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Tracer Study</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('survey.alumni.form') ? 'active' : '' }}"
                       href="{{ route('view.alumni.validation') }}">Survey Alumni</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('survey.alumni_user.form') ? 'active' : '' }}"
                       href="{{ route('view.alumni-user.agreement') }}">Survey Pengguna Alumni</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard.spread') }}">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
