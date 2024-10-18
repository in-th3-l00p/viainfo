<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserInvitationController extends Controller
{
    public function index()
    {
        Gate::authorize('create', User::class);
        return view('admin.users.invitations.index', [
            'invitations' => UserInvitation::query()
                ->orderBy("sent")
                ->get()
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

    public function batchDelete(Request $request)
    {
        Gate::authorize('create', User::class);
        $request->validate([
            "invitations" => "required|array",
            "invitations.*" => "required|exists:user_invitations,id"
        ]);
        return view('admin.users.invitations.batchDelete', [
            'invitations' => UserInvitation::query()
                ->whereIn('id', $request->invitations)
                ->get()
        ]);
    }

    public function batchDestroy(Request $request)
    {
        Gate::authorize('create', User::class);
        $request->validate([
            "invitations" => "required|array",
            "invitations.*" => "required|exists:user_invitations,id"
        ]);
        UserInvitation::query()
            ->whereIn('id', $request->invitations)
            ->delete();
        return redirect()
            ->route('admin.users.invitations.index')
            ->with('success', __('Invitations deleted successfully'));
    }

    public function send(UserInvitation $invitation)
    {
        Gate::authorize('create', User::class);
        $invitation->send();
        return redirect()
            ->route('admin.users.invitations.index')
            ->with('success', __('Invitation sent successfully'));
    }

    public function batchSend(Request $request)
    {
        Gate::authorize('create', User::class);
        $request->validate([
            "invitations" => "required|array",
            "invitations.*" => "required|exists:user_invitations,id"
        ]);
        $invitations = UserInvitation::query()
            ->whereIn('id', $request->invitations)
            ->get();
        $errors = [];
        foreach ($invitations as $invitation) {
            if ($invitation->sent)
                $errors[$invitation->email] = $invitation->email . ": " . __('Already sent');
            $invitation->send();
        }
        return redirect()
            ->route('admin.users.invitations.index')
            ->with('success', __('Invitations sent successfully'))
            ->withErrors($errors);
    }
}
