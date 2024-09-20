<?php

namespace App\Http\Controllers\Admin\Classrooms;

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
        return view("admin.classrooms.index", [
            "classrooms" => Classroom::query()->paginate()
        ]);
    }

    public function create()
    {
        Gate::authorize("create", Classroom::class);
        return view("admin.classrooms.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:255|unique:classrooms,name",
            "slug" => "required|max:255|unique:classrooms,slug",
            "description" => "required|max:1000",
        ]);

        $classroom = Classroom::create([
            "name" => $request->name,
            "slug" => $request->slug,
            "description" => $request->description,
            "owner_id" => Auth::user()->id
        ]);

        return redirect()->route("admin.classrooms.show", [
            "classroom" => $classroom
        ]);
    }

    public function show(Classroom $classroom)
    {
        Gate::authorize("view", $classroom);
        return view("admin.classrooms.show", [
            "classroom" => $classroom
        ]);
    }

    public function edit(Classroom $classroom)
    {
        Gate::authorize("update", $classroom);
        return view("admin.classrooms.edit", [
            "classroom" => $classroom
        ]);
    }

    public function update(
        Request   $request,
        Classroom $classroom
    )
    {
        $classroom->update($request->validate([
            "name" => "required|max:255|unique:classrooms,name",
            "slug" => "required|max:255|unique:classrooms,slug",
            "description" => "required|max:1000",
        ]));
        return view("admin.classrooms.show", [
            "classroom" => $classroom
        ]);
    }

    public function delete(Classroom $classroom)
    {
        Gate::authorize("delete", $classroom);
        return view("admin.classrooms.delete", [
            "classroom" => $classroom
        ]);
    }

    public function destroy(Classroom $classroom)
    {
        Gate::authorize("delete", $classroom);
        $classroom->delete();
        return redirect()
            ->route("admin.classrooms.index")
            ->with(["success" => __("Classroom deleted!")]);
    }

    public function trash()
    {
        Gate::authorize("viewTrashed", Classroom::class);
        return view("admin.classrooms.trash", [
            "classrooms" => Classroom::onlyTrashed()
                ->paginate()
        ]);
    }

    public function restore(Classroom $classroom)
    {
        Gate::authorize("restore", $classroom);
        $classroom->restore();
        return redirect()->route("admin.classrooms.show", [
            "classroom" => $classroom
        ]);
    }
}