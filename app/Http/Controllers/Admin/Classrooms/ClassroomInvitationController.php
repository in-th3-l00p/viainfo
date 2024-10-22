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
        Gate::authorize("update", $classroom);
        if (!$classroom->invitedUsers->contains($user)) {
            return redirect()
                ->back()
                ->withErrors(["user" => __("User is not invited")]);
        }
        $classroom
            ->invitedUsers()
            ->detach($user);
        return redirect()
            ->back()
            ->with(["success" => __("Invitation removed")]);
    }
}
