@php
    use Illuminate\Support\Facades\Request;

    $sidebarMenu = [
        [
            'name' => 'Dashboard',
            'link' => '/dashboard',
        ],
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
@endphp

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
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
