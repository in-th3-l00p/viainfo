<?php

namespace App\Http\Controllers;

use App\Models\Classroom\Classroom;
use App\Models\ClassroomInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClassroomInvitationController extends Controller
{
    /**
     * Accept the invitation for the specified classroom if it exists
     */
    public function accept(
        Request $request,
        Classroom $classroom
    ) {
        // checking if the user is invited to the classroom
        $invitation = $classroom
            ->invitedUsers()
            ->where("user_id", "=", $request->user()->id);
        Gate::denyAsNotFound(!$invitation->exists());
        $invitation->delete();

        // adding user to the classroom
        $classroom->users()->attach($request->user());
        return redirect()
            ->route("classrooms.show", ["classroom" => $classroom])
            ->with("success", "Invitation accepted");
    }

    /**
     * Rejects the invitation for the specified classroom if it exists
     */
    public function reject(
        Request $request,
        Classroom $classroom
    ) {
        $invitation = $classroom
            ->invitedUsers()
            ->where("user_id", "=", $request->user()->id);
        Gate::denyAsNotFound(!$invitation->exists());
        $invitation->delete();
        return redirect()
            ->route("classrooms.index")
            ->with("success", "Invitation rejected");
    }
}
