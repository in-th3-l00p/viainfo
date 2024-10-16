<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // filters the users query based on request parameters
    private function filterUsers(Builder $query, Request $request) {
        $request->validate([
            "search_name" => "nullable|max:255",
            "search_email" => "nullable|max:255",
        ]);

        $query
            ->orderBy("role")
            ->orderBy("id");

        if ($request->search_name)
            $query->where("name", "like", "%" . $request->search_name . "%");
        if ($request->search_email)
            $query->where("email", "like", "%" . $request->search_email . "%");
        if ($request->roles !== null)
            $query->whereIn("role", $request->roles);
        return $query;
    }

    public function index(Request $request) {
        Gate::authorize("viewAny", User::class);
        $users = $this->filterUsers(User::query(), $request);
        return view("admin.users.index", [
            "users" => $users
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function create(Request $request) {
        Gate::authorize("create", User::class);
        return view("admin.users.create");
    }

    public function store(Request $request) {
        Gate::authorize("create", User::class);
        $request->validate([
            "name" => "required|max:255",
            "email" => "required|email:rfc,dns|max:255|unique:users,email",
            "password" => "required|min:8|max:255",
            "role" => "required|in:user,admin"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role
        ]);

        return redirect()
            ->route("admin.users.show", [ "user" => $user ])
            ->with([ "success" => "User created!" ]);
    }

    public function show(Request $request, User $user) {
        Gate::authorize("view", $user);
        return view("admin.users.show", [
            "user" => $user
        ]);
    }

    public function edit(Request $request, User $user) {
        Gate::authorize("update", $user);
        return view("admin.users.edit", [
            "user" => $user
        ]);
    }

    public function update(Request $request, User $user) {
        Gate::authorize("update", $user);
        $data = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email|max:255",
            "role" => "required|in:user,admin"
        ]);
        if ($data["email"] !== $user->email)
            $request->validate([
                "email" => "unique:users,email"
            ]);
        if ($data["name"] !== $user->name)
            $user->update([
                "name" => $data["name"]
            ]);
        if ($data["email"] !== $user->email)
            $user->update([
                "email" => $data["email"]
            ]);
        $user->update([
            "role" => $data["role"]
        ]);
        return redirect()
            ->route("admin.users.show", [ "user" => $user ])
            ->with([ "success" => "User updated!" ]);
    }

    public function delete(Request $request, User $user) {
        Gate::authorize("delete", $user);
        return view("admin.users.delete", [
            "user" => $user
        ]);
    }

    public function destroy(User $user) {
        Gate::authorize("delete", $user);
        $user->delete();
        return redirect()->route("admin.users.index")->with([
            "success" => "User deleted!"
        ]);
    }

    public function trash(Request $request) {
        Gate::authorize("viewAny", User::class);
        $users = $this->filterUsers(User::onlyTrashed(), $request);
        return view("admin.users.trash", [
            "users" => $users
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function restore(User $user) {
        Gate::authorize("restore", $user);
        if (!$user->deleted_at)
            return back()->withErrors([
                "user" => "Not found"
            ]);
        $user->restore();
        return redirect()
            ->route("admin.users.show", [
                "user" => $user
            ])
            ->with([
                "success" => "User restored successfully!"
            ]);
    }
}
