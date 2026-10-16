<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $alertClass;
    public function __construct(string $type = 'info')
    {
        $this->alertClass = match ($type) {
            'success' => 'alert-success',
            'error'   => 'alert-error',
            'warning' => 'alert-warning',
            default   => 'alert-info', 
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
