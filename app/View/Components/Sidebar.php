<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public array $sidebarMenu;
    public array $dashboardMenu;

    public function __construct()
    {
        $this->sidebarMenu = [
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

        $this->dashboardMenu = [
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
                'link' => '/dashboard/wait-period',
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
            ],
            [
                'name' => 'Rekap Alumni Belum isi Survey',
                'link' => '/dashboard/alumni-survey/unfilled',
                'icon' => 'map',
            ],
            [
                'name' => 'Rekap Pengguna Alumni Belum isi Survey',
                'link' => '/dashboard/alumni-user-survey/unfilled',
                'icon' => 'map',
            ]
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'sidebarMenu' => $this->sidebarMenu,
            'dashboardMenu' => $this->dashboardMenu,
        ]);
    }
}
