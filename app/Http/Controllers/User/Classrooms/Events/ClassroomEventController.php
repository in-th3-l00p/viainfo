<?php

namespace App\Http\Controllers\User\Classrooms\Events;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\ClassroomEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class ClassroomEventController extends Controller
{
    public function attendCode(
        Request $request,
        Classroom $classroom,
        ClassroomEvent $event
    ) {
        Gate::authorize("view", [$classroom, $event]);
        return view("user.classrooms.events.attend", [
            "classroom" => $classroom,
            "event" => $event
        ]);
    }

    public function attend(
        Request $request,
        Classroom $classroom,
        ClassroomEvent $event
    ) {
        Gate::authorize("view", [$classroom, $event]);
        Gate::allowIf(
            $event->self_attend &&
            Carbon::now()->between(
                Carbon::create($event->start, "Europe/Bucharest"),
                Carbon::create($event->end, "Europe/Bucharest")
            )
        );
        $request->validate([
            "attend_code" => "required"
        ]);

        if ($request->attend_code !== $event->attend_code)
            return back()
                ->withErrors(["attend_code" => __("Invalid attend code")]);
        $event->attendances()->attach(auth()->id());
        return redirect()
            ->route("classrooms.show", [ "classroom" => $classroom ])
            ->with("success", __("You have successfully attended the event"));
    }

    public function unattend(
        Classroom $classroom,
        ClassroomEvent $event
    ) {
        Gate::authorize("view", [$classroom, $event]);
        Gate::allowIf(
            $event->self_attend &&
            Carbon::now()->between(
                Carbon::create($event->start, "Europe/Bucharest"),
                Carbon::create($event->end, "Europe/Bucharest")
            )
        );
        $event->attendances()->detach(auth()->id());
        return redirect()
            ->route("classrooms.show", [ "classroom" => $classroom ])
            ->with("success", __("You have successfully unattended the event"));
    }
}
