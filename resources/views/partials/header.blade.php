<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Tracer Study</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap d-flex align-items-center">
            <span class="text-white me-2 fs-6">
                {{ auth()->user()->name }}
            </span>
            <button class="btn btn-link text-white" data-bs-toggle="modal" data-bs-target="#modal-confirm-logout">
                Logout
            </button>
        </div>
    </div>
</header>


<x-modal-confirm id="logout" method="GET" title="Yakin keluar?" action="/logout" />
