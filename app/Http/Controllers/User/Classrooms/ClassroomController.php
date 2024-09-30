<?php

namespace App\Http\Controllers\User\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ClassroomController extends Controller
{
    public function index()
    {
        Gate::authorize("viewAny", Classroom::class);
        return view("user.classrooms.index", [
            "classrooms" => Auth::user()->classrooms()->paginate()
        ]);
    }

    public function show(Classroom $classroom)
    {
        Gate::authorize("view", $classroom);
        return view("user.classrooms.show", [
            "classroom" => $classroom
        ]);
    }

    public function leaveForm(Classroom $classroom) {
        Gate::authorize("view", $classroom);
        return view("user.classrooms.leave", [
            "classroom" => $classroom
        ]);
    }

    public function leave(Classroom $classroom) {
        Gate::authorize("view", $classroom);
        Auth::user()->classrooms()->detach($classroom);
        return redirect()
            ->route("classrooms.index")
            ->with("success", __("You have left the classroom successfully."));
    }
}
