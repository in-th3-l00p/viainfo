@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Edit user') . ' ' . $user->name"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Edit ') . ' \'\'' . $user->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Update user's information") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.users.update", [ "user" => $user ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf
            @method("PUT")

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to update this user')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("User's name") }}"
                    value="{{ $user->name }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="email" class="label w-32">{{ __("Email") }}:</label>
                <input
                    type="email" name="email" id="email"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("email")])
                    placeholder="{{ __("User's email") }}"
                    value="{{ $user->email }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="role" class="label w-32">{{ __("Role") }}:</label>
                <select
                    name="role" id="role"
                    class="select"
                >
                    <option
                        value="user"
                        @selected("user" === $user->role)
                    >{{ __("User") }}</option>
                    <option
                        value="admin"
                        @selected("admin" === $user->role)
                    >{{ __("Admin") }}</option>
                </select>
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Edit") }}"
            >
                {{ __("Edit") }}
            </button>
        </form>
    </x-layout>
@endsection
