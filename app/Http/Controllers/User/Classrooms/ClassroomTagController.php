<?php

namespace App\Http\Controllers\User\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom\Classroom;
use App\Models\Classroom\ClassroomTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ClassroomTagController extends Controller
{
    public function index() {
        Gate::authorize("viewAny", ClassroomTag::class);
        return view("admin.classrooms.tags.index", [
            "tags" => ClassroomTag::all()
        ]);
    }

    public function create(Classroom $classroom) {
        Gate::authorize("create", ClassroomTag::class);
        return view("admin.classrooms.tags.create", [
            "classroom" => $classroom
        ]);
    }

    public function store(
        Classroom $classroom,
        Request $request
    ) {
        Gate::authorize("create", ClassroomTag::class);
        $request->validate([
            "name" => "required|max:255"
        ]);
        $tag = ClassroomTag::query()
            ->where("name", "=", $request->name)
            ->first();
        if (!$tag)
            $tag = ClassroomTag::create([
                "name" => $request->name
            ]);
        $classroom->tags()->attach($tag);
        return redirect()
            ->route("admin.classrooms.show", [
                "classroom" => $classroom
            ])
            ->with([ "success" => __("Tag added!") ]);

    }

    public function show(ClassroomTag $tag) {
        Gate::authorize("view", $tag);
        return view("admin.classrooms.tags.show", [
            "tag" => $tag
        ]);
    }

    public function edit(ClassroomTag $tag) {
        Gate::authorize("update", $tag);
        return view("admin.classrooms.tags.edit", [
            "tag" => $tag
        ]);
    }

    public function update(
        Request $request,
        ClassroomTag $tag
    ) {
        Gate::authorize("update", $tag);
        $body = $request->validate([
            "name" => "required|max:255"
        ]);
        $tag->update($body);
        return redirect()
            ->route("admin.tags.show", ["tag" => $tag])
            ->with([
                "success" => __("Tag updated successfully!")
            ]);
    }

    public function destroy(
        Classroom $classroom,
        ClassroomTag $tag
    ) {
        Gate::authorize("delete", $tag);
        $classroom->tags()->detach($tag);
        if ($tag->classrooms()->count() === 0) {
            $tag->delete();
            return redirect()
                ->route("admin.classrooms.tags.index")
                ->with([
                    "success" => __("Tag removed!"),
                    "info" => __("You were redirect as there were no more classrooms associated with that tag.")
                ]);
        }

        return redirect()
            ->back()
            ->with([ "success" => __("Tag removed!") ]);
    }

    public function destroyBatch(
        Request $request,
        Classroom $classroom
    ) {
        $tags = collect([]);
        foreach ($request->tags as $tagId)
            $tags->push(ClassroomTag::findOrFail($tagId));
        $classroom->tags()->detach($request->tags);
        foreach ($tags as $tag)
            if ($tag->classrooms()->count() === 0)
                $tag->delete();

        $message = "Tag";
        if (sizeof($request->tags) > 1)
            $message = Str::plural($message);
        $message = $message . " removed!";
        return back()->with([
            "success" => __($message)
        ]);
    }
}
