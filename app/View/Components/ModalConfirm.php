<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalConfirm extends Component
{
    public $id;
    public $title;
    public $action;
    public $method;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $title, $action, $method)
    {
        $this->id = $id;
        $this->title = $title;
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-confirm');
    }
}