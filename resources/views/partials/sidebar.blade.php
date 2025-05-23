@php
    use Illuminate\Support\Facades\Request;

    $sidebarMenu = [
        [
            'name' => 'Mahasiswa',
            'link' => '/student',
        ],
        [
            'name' => 'Admin',
            'link' => '/admin',
        ],
        [
            'name' => 'Program Studi',
            'link' => '/study-program',
        ],
        [
            'name' => 'Profesi',
            'link' => '/profession',
        ],
        [
            'name' => 'Test Crud',
            'link' => '/test-crud',
        ],
    ];

    $dashboardMenu = [
        [
            'name' => 'Sebaran',
            'link' => '/dashboard/spread',
        ],
        [
            'name' => 'Penilaian',
            'link' => '/dashboard/evaluation',
        ],
        [
            'name' => 'Masa Tunggu',
            'link' => '/dashboard/wait-periode',
        ],
    ];
@endphp

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    Dashboard
                </h6>
                <ul class="nav flex-column">
                    @foreach ($dashboardMenu as $menu)
                        @php
                            $isActive = Request::is(ltrim($menu['link'], '/')) ? 'active' : '';
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ $isActive }}" href="{{ $menu['link'] }}">
                                {{-- <span data-feather="{{ $menu['icon'] }}"></span> --}}
                                {{ $menu['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    Data manajemen
                </h6>
                <ul class="nav flex-column">
                    @foreach ($sidebarMenu as $menu)
                        @php
                            $isActive = Request::is(ltrim($menu['link'], '/')) ? 'active' : '';
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ $isActive }}" href="{{ $menu['link'] }}">
                                {{-- <span data-feather="{{ $menu['icon'] }}"></span> --}}
                                {{ $menu['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</div>
