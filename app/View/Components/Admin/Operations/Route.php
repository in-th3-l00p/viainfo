<?php

namespace App\View\Components\Admin\Operations;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Route extends Component
{
    public function __construct(
        public string $title,
        public string $href,
        public string $icon
    ) { }

    public function render(): View|Closure|string {
        return view('components.admin.operations.route');
    }
}
