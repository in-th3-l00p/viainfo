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
            "classrooms" => Auth::user()->classrooms
        ]);
    }

    public function show(Classroom $classroom)
    {
        Gate::authorize("view", $classroom);
        return view("user.classrooms.show", [
            "classroom" => $classroom
        ]);
    }
}
