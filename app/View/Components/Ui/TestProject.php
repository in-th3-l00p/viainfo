<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestProject extends Component
{
    public function __construct(
        public \App\Models\TestProjects\TestProject $testProject
    ) {
    }

    public function render(): View|Closure|string {
        return view('components.ui.test-project');
    }
}
