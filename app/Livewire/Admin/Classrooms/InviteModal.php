<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom\Classroom;
use Livewire\Component;

class InviteModal extends Component
{
    public Classroom $classroom;

    public function render()
    {
        return view('livewire.admin.classrooms.invite-modal');
    }
}
