<?php

namespace App\Livewire\Admin\Classrooms;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class InviteModal extends Component
{
    public Classroom $classroom;
    public $selectedUsers = [];
    public string $search = "";

    public function render()
    {
        return view('livewire.admin.classrooms.invite-modal', [
            "users" => User::query()
                ->whereDoesntHave("classrooms", function ($query) {
                    $query->where("classroom_id", "=", $this->classroom->id);
                })
                ->when(strlen($this->search) > 0, function ($query) {
                    $query
                        ->where("name", "like", "%{$this->search}%")
                        ->orWhere("email", "like", "%{$this->search}%");
                })
                ->paginate(5)
        ]);
    }

    public function invite() {
        $this->validate([
            "selectedUsers" => "required|array|min:1",
            "selectedUsers.*" => "exists:users,id"
        ]);
        foreach ($this->selectedUsers as $userId) {
            if ($this->classroom->invitedUsers()->where("user_id", "=", $userId)->exists())
                continue;
            $this
                ->classroom
                ->invitedUsers()
                ->attach($userId);
        }
        $this->dispatch("users-invited");
    }

    #[On("search-updated")]
    public function refresh() {
    }
}
