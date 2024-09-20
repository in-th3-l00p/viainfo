<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Container extends Component
{
    public function __construct(
        public string $title,
        public ?array $breadcrumbPath = null
    ) { }

    public function render(): View|Closure|string {
        return view('components.admin.container');
    }
}
