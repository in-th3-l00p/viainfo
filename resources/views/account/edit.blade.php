@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Edit profile')"
        :breadcrumbPath="[
            [ 'href' => route(request()->user()->role . '.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('account.index'), 'name' => __('Account') ],
            [ 'name' => __('Edit profile') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Update your information") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("account.update") }}"
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
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("User's name") }}"
                    value="{{ request()->user()->name }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="email" class="label w-32">{{ __("Email") }}:</label>
                <input
                    type="email" name="email" id="email"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("email")])
                    placeholder="{{ __("User's email") }}"
                    value="{{ request()->user()->email }}"
                >
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
