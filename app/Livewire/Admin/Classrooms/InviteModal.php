<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Livewire\Component;

class InviteModal extends Component
{
    public Classroom $classroom;
    public $selectedUsers = [];

    public function render()
    {
        return view('livewire.admin.classrooms.invite-modal', [
            "users" => User::query()
//                ->join("classroom_user", "users.id", "=", "classroom_user.user_id")
//                ->where("classroom_user.classroom_id", "!=", $this->classroom->id)
                ->get()
        ]);
    }

    public function invite() {
        dd($this->selectedUsers);
    }
}
