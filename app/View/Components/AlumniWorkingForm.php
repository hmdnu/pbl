<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlumniWorkingForm extends Component
{
    public string $professionCategory;

    /**
     * Create a new component instance.
     */
    public function __construct(string $professionCategory)
    {
        $this->professionCategory = $professionCategory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alumni-working-form');
    }
}
