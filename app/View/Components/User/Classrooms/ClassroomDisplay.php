<?php

namespace App\View\Components\User\Classrooms;

use App\Models\Classroom\Classroom;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClassroomDisplay extends Component
{
    public function __construct(
        public Classroom $classroom
    ) {
    }

    public function render(): View|Closure|string {
        return view('components.user.classrooms.classroom-display');
    }
}
