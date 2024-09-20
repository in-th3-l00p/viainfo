<?php

namespace App\View\Components\Admin\TestProjects;

use App\Models\TestProjects\TestProject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrashedTestProjectDisplay extends Component
{
    public function __construct(
        public TestProject $testProject
    ) {
    }

    public function render(): View|Closure|string {
        return view('components.admin.test-projects.trashed-test-project-display');
    }
}
