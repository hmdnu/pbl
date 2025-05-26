<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 d-flex align-items-center gap-2" href="#">
        <img src="/img/jti.png" alt="Logo" class="header-logo">
        <div class="d-flex flex-column lh-sm">
            <span class="fw-bold text-white">POLITEKNIK NEGERI MALANG</span>
            <small class="text-light">Tracer Study - Teknologi Informasi</small>
        </div>
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav pe-3">
    <div class="nav-item text-nowrap d-flex align-items-center gap-3">
        <div class="d-flex align-items-center gap-2 text-white">
            <i data-feather="user" class="text-white"></i>
            <span class="fs-6">{{ auth()->user()->name }}</span>
        </div>
        <button class="btn btn-outline-light btn-sm d-flex align-items-center gap-1"
            data-bs-toggle="modal" data-bs-target="#modal-confirm-logout">
            <i data-feather="log-out" class="text-white"></i>
            Logout
        </button>
    </div>
</div>
</header>


<x-modal-confirm id="logout" method="GET" title="Yakin keluar?" action="/logout" />
