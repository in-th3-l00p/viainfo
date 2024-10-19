<?php

namespace App\Http\Controllers\Admin\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClassroomInvitationController extends Controller
{
    public function destroy(
        Request $request,
        Classroom $classroom,
        User $user
    ) {
        Gate::denyAsNotFound(
            !$classroom
                ->invitedUsers()
                ->where("user_id", "=", $request->user()->id)
                ->exists() ||
            $request->user()->role !== "admin" ||
            !$classroom
                ->teachers()
                ->where("user_id", "=", $user->id)->exists()
        );
        $classroom
            ->invitedUsers()
            ->detach($user);
        return redirect()
            ->back()
            ->with("success", "Invitation removed");
    }
}
