@php
    use Illuminate\Support\Facades\Request;

    $sidebarMenu = [
        [
            'name' => 'Mahasiswa',
            'link' => '/student',
            'icon' => 'user',
        ],
        [
            'name' => 'Admin',
            'link' => '/admin',
            'icon' => 'shield',
        ],
        [
            'name' => 'Program Studi',
            'link' => '/study-program',
            'icon' => 'book-open'
        ],
        [
            'name' => 'Profesi',
            'link' => '/profession',
            'icon' => 'briefcase',
        ],
        [
            'name' => 'Test Crud',
            'link' => '/test-crud',
            'icon' => 'file-text',
        ],
    ];

    $dashboardMenu = [
        [
            'name' => 'Dashboard',
            'link' => '/dashboard',
            'icon' => 'map'
        ],
        [
            'name' => 'Sebaran',
            'link' => '/dashboard/spread',
            'icon' => 'map',
        ],
        [
            'name' => 'Penilaian',
            'link' => '/dashboard/evaluation',
            'icon' => 'bar-chart-2',
        ],
        [
            'name' => 'Masa Tunggu',
            'link' => '/dashboard/wait-periode',
            'icon' => 'clock',
        ],
        [
            'name' => 'Rekap Survey Alumni',
            'link' => '/dashboard/alumni-survey/recap',
            'icon' => 'map'
        ],
        [
            'name' => 'Rekap Survey Pengguna Alumni',
            'link' => '/dashboard/alumni-user-survey/recap',
            'icon' => 'map'
        ]
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
                                <span data-feather="{{ $menu['icon'] }}"></span>
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
                                <span data-feather="{{ $menu['icon'] }}"></span>
                                {{ $menu['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</div>
