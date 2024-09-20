@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Create user')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Create') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Complete the fields related to the user's data") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.users.store") }}"
            method="post"
            class="max-w-xl"
        >
            @csrf

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to create this user')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("User's name") }}"
                    value="{{ old("name") }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="email" class="label w-32">{{ __("Email") }}:</label>
                <input
                    type="email" name="email" id="email"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("email")])
                    placeholder="{{ __("User's email") }}"
                    value="{{ old("email") }}"
                >
            </div>

            <div
                x-data="{ show: false }"
                class="form-group mb-4 relative"
            >
                <label for="password" class="label w-32">{{ __("Password") }}:</label>

                <input
                    x-bind:type="show ? 'text' : 'password'"
                    name="password" id="password"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("password")])
                    placeholder="{{ __("User's password") }}"
                >
                <button
                    type="button"
                    x-bind:title="show ?
                        '{{ __("Hide password") }}' :
                        '{{ __("Show password") }}'"
                    @class([
                        "absolute right-0 top-1/2 -translate-y-1/2 me-2",
                        "hover:scale-110 group transition-all"
                    ])
                    @click="show = !show"
                >
                    <i
                        x-show="!show"
                        @class([
                            "fa-regular fa-eye",
                            "text-gray-400 group-hover:text-zinc-700 transition-all"
                        ])
                    ></i>

                    <i
                        x-show="show"
                        @class([
                            "fa-regular fa-eye-slash",
                            "text-gray-400 group-hover:text-zinc-700 transition-all"
                        ])
                    ></i>
                </button>
            </div>

            <div class="form-group mb-8">
                <label for="role" class="label w-32">{{ __("Role") }}:</label>
                <select
                    name="role" id="role"
                    class="select"
                >
                    <option
                        value="user"
                        @selected("user" === old("role"))
                    >{{ __("User") }}</option>
                    <option
                        value="admin"
                        @selected("admin" === old("role"))
                    >{{ __("Admin") }}</option>
                </select>
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
