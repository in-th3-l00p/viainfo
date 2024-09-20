<?php

namespace App\Policies;

use App\Models\Classroom\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassroomPolicy
{
    public function viewAny(User $user): bool {
        return true;
    }

    public function view(User $user, Classroom $classroom): bool {
        return $user->role === "admin";
    }

    public function create(User $user): bool {
        return $user->role === "admin";
    }

    public function update(User $user, Classroom $classroom): bool {
        return $user->role === "admin";
    }

    public function delete(User $user, Classroom $classroom): bool {
        return $user->role === "admin";
    }

    public function restore(User $user, Classroom $classroom): bool {
        return $user->role === "admin";
    }

    public function forceDelete(User $user, Classroom $classroom): bool {
        return $user->role === "admin";
    }
}
