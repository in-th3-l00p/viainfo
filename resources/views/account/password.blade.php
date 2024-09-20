@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Change password')"
        :breadcrumbPath="[
            [ 'href' => route(request()->user()->role . '.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('account.index'), 'name' => __('Account') ],
            [ 'name' => __('Change password') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Update your password") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("account.password.update") }}"
            method="post"
            class="max-w-xl"
        >
            @csrf
            @method("PUT")

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to update your profile')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="current_password" class="label w-64">{{ __("Current password") }}:</label>
                <input
                    type="password" name="current_password" id="current_password"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("current_password")])
                    placeholder="{{ __("User's current password") }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="password" class="label w-64">{{ __("New password") }}:</label>
                <input
                    type="password" name="password" id="password"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("password")])
                    placeholder="{{ __("New password") }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation" class="label w-64">{{ __("Confirm password") }}:</label>
                <input
                    type="password" name="password_confirmation" id="password_confirmation"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("password_confirmation")])
                    placeholder="{{ __("User's current password") }}"
                >
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Update") }}"
            >
                {{ __("Update") }}
            </button>
        </form>
    </x-layout>
@endsection
