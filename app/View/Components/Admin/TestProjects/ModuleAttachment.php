<?php

namespace App\View\Components\Admin\TestProjects;

use App\Models\TestProjects\TestProjectAttachment;
use App\Models\TestProjects\TestProjectModule;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleAttachment extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public TestProjectModule $module,
        public TestProjectAttachment $attachment
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.test-projects.module-attachment');
    }
}
