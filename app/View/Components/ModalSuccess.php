<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalSuccess extends Component
{
    public $title;
    public $confirmText;

    public function __construct($title = '', $confirmText = 'Yes, I\'m sure')
    {
        $this->title = $title;
        $this->confirmText = $confirmText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-success');
    }
}
