<?php

namespace App\Http\Controllers\Admin\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClassroomUserController extends Controller
{
    public function update(
        Request $request,
        Classroom $classroom,
        User $user
    ) {
        Gate::denyAsNotFound(
            !$classroom
                ->users()
                ->where("user_id", "=", $request->user()->id)
                ->exists() ||
            $request->user()->role !== "admin" ||
            !$classroom
                ->teachers()
                ->where("user_id", "=", $user->id)->exists()
        );

        $request->validate([
            "role" => "required|string|in:student,teacher"
        ]);
        $classroom
            ->users()
            ->updateExistingPivot($user, ["role" => $request->role]);
        return redirect()
            ->back()
            ->with("success", "User role updated");
    }

    public function delete(
        Request $request,
        Classroom $classroom,
        User $user
    ) {
        Gate::denyAsNotFound(
            !$classroom
                ->users()
                ->where("user_id", "=", $request->user()->id)
                ->exists() ||
            $request->user()->role !== "admin" ||
            !$classroom
                ->teachers()
                ->where("user_id", "=", $user->id)->exists()
        );
        return view("admin.classrooms.users.delete", [
            "classroom" => $classroom,
            "user" => $user
        ]);
    }

    public function destroy(
        Classroom $classroom,
        User $user
    ) {
        Gate::denyAsNotFound(
            !$classroom
                ->users()
                ->where("user_id", "=", $request->user()->id)
                ->exists() ||
            $request->user()->role !== "admin" ||
            !$classroom
                ->teachers()
                ->where("user_id", "=", $user->id)->exists()
        );
        $classroom
            ->users()
            ->detach($user);
        return redirect()
            ->back()
            ->with("success", "User removed");
    }
}
