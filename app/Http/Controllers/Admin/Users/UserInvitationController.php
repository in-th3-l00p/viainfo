<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserInvitationController extends Controller
{
    public function index()
    {
        Gate::authorize('create', User::class);
        return view('admin.users.invitations.index', [
            'invitations' => UserInvitation::all()
        ]);
    }

    public function create()
    {
        Gate::authorize('create', User::class);
        return view('admin.users.invitations.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', User::class);
        if ($request->hasFile("csv")) {
            $request->validate([
                'csv' => 'required|file|mimes:csv,txt'
            ]);

            $csv = array_map('str_getcsv', file($request->file('csv')));
            $header = array_map('strtolower', array_shift($csv));

            $nameIndex = array_search('name', $header);
            $emailIndex = array_search('email', $header);

            if ($nameIndex === false || $emailIndex === false)
                return redirect()
                    ->back()
                    ->withErrors(['csv' => __('Invalid CSV file')]);

            $errors = [];
            foreach ($csv as $index => $row) {
                $name = trim($row[$nameIndex]);
                $email = trim($row[$emailIndex]);

                $validator = Validator::make([
                    'name' => $name,
                    'email' => $email
                ], [
                    'name' => 'required|max:255',
                    'email' => [
                        'required',
                        'email:rfc,dns',
                        'max:255',
                        'unique:users,email',
                        'unique:user_invitations,email'
                    ]
                ]);
                if ($validator->fails()) {
                    foreach ($validator->messages()->messages() as $key => $error)
                        $errors[$index . '-' . $key] =
                            __("Row's") . " " . $index  . " " . $key . ' - ' .
                            ($key === "name" ? $name : $email) .
                            ": " .
                            $error[0];
                }
            }

            foreach ($csv as $index => $row) {
                if (
                    array_key_exists($index . '-email', $errors) ||
                    array_key_exists($index . '-name', $errors) ||
                    UserInvitation::query()
                        ->where("email", "=", $row[$emailIndex])
                        ->exists()
                )
                    continue;
                $name = $row[$nameIndex];
                $email = $row[$emailIndex];

                // generating an unique token
                $token = Str::uuid();
                while (UserInvitation::query()->where('token', $token)->exists())
                    $token = Str::uuid();

                // storing the invitation
                UserInvitation::create([
                    'email' => $email,
                    'name' => $name,
                    'token' => $token,
                    'invited_by' => auth()->id()
                ]);
            }

            return redirect()
                ->route('admin.users.invitations.index')
                ->with('success', __('Invitations sent successfully'))
                ->withErrors($errors);
        } else {
            $request->validate([
                'name' => 'required|max:255',
                'email' => [
                    'required',
                    'email:rfc,dns',
                    'max:255',
                    'unique:users,email',
                    'unique:user_invitations,email'
                ]
            ]);

            // generating an unique token
            $token = Str::uuid();
            while (UserInvitation::query()->where('token', $token)->exists())
                $token = Str::uuid();

            // storing the invitation
            UserInvitation::create([
                'email' => $request->email,
                'name' => $request->name,
                'token' => $token,
                'invited_by' => auth()->id()
            ]);

            return redirect()
                ->route('admin.users.invitations.index')
                ->with('success', __('Invitation sent successfully'));
        }
    }

    public function delete(UserInvitation $invitation)
    {
        Gate::authorize('create', User::class);
        return view('admin.users.invitations.delete', [
            'invitation' => $invitation
        ]);
    }

    public function destroy(UserInvitation $invitation)
    {
        Gate::authorize('create', User::class);
        $invitation->delete();
        return redirect()
            ->route('admin.users.invitations.index')
            ->with('success', __('Invitation deleted successfully'));
    }
}
