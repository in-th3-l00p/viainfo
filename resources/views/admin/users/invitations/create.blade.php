@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Create User Invitation')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'href' => route('admin.users.invitations.index'), 'name' => __('User Invitations') ],
            [ 'name' => __('Create') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Complete the fields related to the user invitation's data") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        @if ($errors->any())
            <div class="mb-16">
                <x-admin.errors-alert
                    :text="__('the following errors occurred when trying to create this user invitation')"
                    :errors="$errors"
                />
            </div>
        @endif

        <h2 class="mb-2">{{ __("Using a CSV") }}:</h2>
        <form
            action="{{ route("admin.users.invitations.store") }}"
            method="post"
            class="max-w-xl mb-16"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="form-group mb-4">
                <label for="csv" class="label w-32">{{ __("CSV") }}:</label>
                <input
                    type="file" name="csv" id="csv"
                    @class(["input bg-white", "ring-2 ring-rose-600" => $errors->has("csv")])
                >
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Create") }}"
            >
                {{ __("Create") }}
            </button>
        </form>

        <h2 class="mb-2">{{ __("Using a name and email") }}:</h2>
        <form
            action="{{ route("admin.users.invitations.store") }}"
            method="post"
            class="max-w-xl"
        >
            @csrf

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Invited user's name") }}"
                    value="{{ old("name") }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="email" class="label w-32">{{ __("Email") }}:</label>
                <input
                    type="email" name="email" id="email"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("email")])
                    placeholder="{{ __("Invited user's email") }}"
                    value="{{ old("email") }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="classroom" class="label w-32">{{ __("Classroom's name") }}:</label>
                <input
                    type="text" name="classroom" id="classroom"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("classroom")])
                    placeholder="{{ __("Classroom's name") }}"
                    value="{{ old("classroom") }}"
                >
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Create") }}"
            >
                {{ __("Create") }}
            </button>
        </form>
    </x-layout>
@endsection
