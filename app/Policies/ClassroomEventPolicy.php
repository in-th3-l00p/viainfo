<?php

namespace App\Policies;

use App\Models\Classroom\Classroom;
use App\Models\Classroom\ClassroomEvent;
use App\Models\User;

class ClassroomEventPolicy
{
    public function viewAny(User $user, Classroom $classroom): bool
    {
        return
            $user->role === 'admin' ||
            $classroom
                ->users()
                ->where('user_id', $user->id)
                ->exists();
    }

    public function view(
        User $user,
        Classroom $classroom,
        ClassroomEvent $classroomEvent
    ): bool
    {
        return
            $user->role === 'admin' ||
            $classroom
                ->users()
                ->where('user_id', $user->id)
                ->exists();
    }

    public function create(User $user, Classroom $classroom): bool
    {
        return
            $user->role === 'admin' ||
            $classroom
                ->users()
                ->where('user_id', $user->id)
                ->where('role', 'teacher')
                ->exists();
    }

    public function update(User $user, Classroom $classroom, ClassroomEvent $classroomEvent): bool
    {
        return
            $user->role === 'admin' ||
            $classroom
                ->users()
                ->where('user_id', $user->id)
                ->where('role', 'teacher')
                ->exists();
    }

    public function delete(User $user, Classroom $classroom, ClassroomEvent $classroomEvent): bool
    {
        return
            $user->role === 'admin' ||
            $classroom
                ->users()
                ->where('user_id', $user->id)
                ->where('role', 'teacher')
                ->exists();
    }

    public function restore(User $user, Classroom $classroom, ClassroomEvent $classroomEvent): bool
    {
        return
            $user->role === 'admin' ||
            $classroom
                ->users()
                ->where('user_id', $user->id)
                ->where('role', 'teacher')
                ->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Classroom $classroom, ClassroomEvent $classroomEvent): bool
    {
        return
            $user->role === 'admin' ||
            $classroom
                ->users()
                ->where('user_id', $user->id)
                ->where('role', 'teacher')
                ->exists();
    }
}
