<?php

namespace App\Http\Controllers\Admin\Classrooms\Events;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\ClassroomEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClassroomEventController extends Controller
{
    public function create(Classroom $classroom)
    {
        Gate::authorize("create", [ClassroomEvent::class, $classroom]);
        return view("admin.classrooms.events.create", compact("classroom"));
    }

    public function store(Request $request, Classroom $classroom)
    {
        Gate::authorize("create", [ClassroomEvent::class, $classroom]);
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "start_date" => "required|date",
            "end_date" => "required|date",
        ]);

        ClassroomEvent::create([
            "title" => $request->title,
            "description" => $request->description,
            "start" => $request->start_date,
            "end" => $request->end_date,
            "classroom_id" => $classroom->id,
            "owner_id" => $request->user()->id(),
        ]);

        return redirect()
            ->route("admin.classrooms.show", $classroom)
            ->with("success", __("Event created successfully"));
    }

    public function edit(Classroom $classroom, ClassroomEvent $event)
    {
        Gate::authorize("update", $event);
        return view(
            "admin.classrooms.events.edit",
            compact("classroom", "event")
        );
    }

    public function update(Request $request, Classroom $classroom, ClassroomEvent $event)
    {
        Gate::authorize("update", $event);
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "start_date" => "required|date",
            "end_date" => "required|date",
        ]);

        $event->update([
            "title" => $request->title,
            "description" => $request->description,
            "start" => $request->start_date,
            "end" => $request->end_date,
        ]);

        return redirect()
            ->route("admin.classrooms.show", $classroom)
            ->with("success", __("Event updated successfully"));
    }

    public function delete(Classroom $classroom, ClassroomEvent $event)
    {
        Gate::authorize("delete", $event);
        return view(
            "admin.classrooms.events.delete",
            compact("classroom", "event")
        );
    }

    public function destroy(Classroom $classroom, ClassroomEvent $event)
    {
        Gate::authorize("delete", $event);
        $event->delete();
        return redirect()
            ->route("admin.classrooms.show", $classroom)
            ->with("success", __("Event deleted successfully"));
    }

    public function trash(Classroom $classroom)
    {
        Gate::authorize("viewTrashed", [ClassroomEvent::class, $classroom]);
        $events = ClassroomEvent::onlyTrashed()
            ->where("classroom_id", $classroom->id)
            ->get();
        return view(
            "admin.classrooms.events.trash",
            compact("classroom", "events")
        );
    }

    public function restore(Classroom $classroom, ClassroomEvent $event)
    {
        Gate::authorize("restore", $event);
        $event->restore();
        return redirect()
            ->route("admin.classrooms.show", $classroom)
            ->with("success", __("Event restored successfully"));
    }
}
