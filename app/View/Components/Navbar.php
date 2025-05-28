<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public array $items;

    public function __construct()
    {
        $this->items = [
            [
                'name' => 'Survey Alumni',
                'route' => 'view.alumni.validation',
                'active_when' => 'survey.alumni.form'
            ],
            [
                'name' => 'Survey Pengguna Alumni',
                'route' => 'view.alumni-user.agreement',
                'active_when' => 'survey.alumni_user.form'
            ],
            [
                'name' => 'Dashboard',
                'route' => 'dashboard.spread',
                'active_when' => 'dashboard'
            ]
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
