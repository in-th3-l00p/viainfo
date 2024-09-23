<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        $users = User::query()
            ->when(
                $request->query("query"),
                fn ($users) => $users
                    ->where("name", "LIKE", "%{$request->query('query')}%")
            );
        return PublicUserResource::collection($users->paginate());
    }
}
