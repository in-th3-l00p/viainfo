<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom\Classroom;
use Livewire\Attributes\On;
use Livewire\Component;

class InvitedUsers extends Component
{
    public Classroom $classroom;

    public function render()
    {
        return view('livewire.admin.classrooms.invited-users');
    }

    #[On("users-invited")]
    public function refresh() {
    }
}
