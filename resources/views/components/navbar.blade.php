<nav class="navbar navbar-expand-lg bg-light border-bottom shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Tracer Study</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @foreach ($items as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($item['active_when']) ? 'active' : '' }}"
                           href="{{ route($item['route']) }}">
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
