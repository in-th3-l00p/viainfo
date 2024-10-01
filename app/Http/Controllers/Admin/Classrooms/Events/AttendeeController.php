<?php

namespace App\Http\Controllers\Admin\Classrooms\Events;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\ClassroomEvent;
use App\Models\User;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function index(Classroom $classroom, ClassroomEvent $event) {
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
        $event->attendances()->detach($user);
        return redirect()
            ->back()
            ->with("success", __("The user has been marked as not attended"));
    }
}