<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalAlert extends Component
{
    public $title;
    public $body;
    public $confirmText;
    public $cancelText;

    public function __construct($title = '', $confirmText = 'Yes, I\'m sure', $cancelText = 'No, cancel')
    {
        $this->title = $title;
        $this->confirmText = $confirmText;
        $this->cancelText = $cancelText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-alert');
    }
}
