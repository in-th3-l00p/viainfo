<?php

namespace App\Http\Controllers\Admin\Classrooms\Events;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\Classroom\ClassroomEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttendeeController extends Controller
{
    public function index(Classroom $classroom, ClassroomEvent $event) {
        Gate::authorize("update", [$classroom, $event]);
        return view("admin.classrooms.events.attendees.index", [
            "classroom" => $classroom,
            "event" => $event
        ]);
    }

    public function markAsAttended(
        Classroom $classroom,
        ClassroomEvent $event,
        User $user,
        Request $request
    ) {
        Gate::authorize("update", [$classroom, $event]);
        $event->attendances()->attach($user);
        return redirect()
            ->back()
            ->with("success", __("The user has been marked as attended"));
    }

    public function markAsNotAttended(
        Classroom $classroom,
        ClassroomEvent $event,
        User $user,
        Request $request
    ) {
        Gate::authorize("update", [$classroom, $event]);
        $event->attendances()->detach($user);
        return redirect()
            ->back()
            ->with("success", __("The user has been marked as not attended"));
    }

    public function showAttendCode(Classroom $classroom, ClassroomEvent $event) {
        Gate::authorize("update", [$classroom, $event]);
        Gate::denyAsNotFound($event->self_attend === null);
        return view(
            "admin.classrooms.events.attendees.show-attend-code",
            compact("classroom", "event")
        );
    }
}
