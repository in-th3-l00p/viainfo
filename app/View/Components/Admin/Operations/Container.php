<?php

namespace App\View\Components\Admin\Operations;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Container extends Component
{
    public function __construct(
        public ?string $text = null
    ) { }

    public function render(): View|Closure|string {
        return view('components.admin.operations.container');
    }
}
