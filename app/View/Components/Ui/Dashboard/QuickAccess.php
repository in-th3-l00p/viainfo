<?php

namespace App\View\Components\Ui\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuickAccess extends Component
{
    public function __construct(
        public string $title,
        public string $description,
        public string $icon,
        public string $href
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.dashboard.quick-access');
    }
}
