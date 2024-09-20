@extends("layouts.main")

@push("vite")
    @vite([ "resources/js/admin/classrooms/create.js" ])
@endpush

@section("content")
    <x-layout
        :title="__('Create classroom')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.classrooms.index'), 'name' => __('Classrooms') ],
            [ 'name' => __('Create') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Complete the fields related to the classroom's data") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.classrooms.store") }}"
            method="post"
            class="max-w-xl"
        >
            @csrf

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to create this classroom')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Classroom's name") }}"
                    value="{{ old("name") }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="slug" class="label w-32">{{ __("Slug") }}:</label>
                <div class="relative w-full">
                    <input
                        type="text" name="slug" id="slug"
                        @class(["input", "ring-2 ring-rose-600" => $errors->has("slug")])
                        placeholder="{{ __("Classroom's slug") }}"
                        value="{{ old("slug") }}"
                    >

                    <button
                        type="button"
                        title="{{ __("Auto generate") }}"
                        onclick="generateSlug()"
                        class="icon-btn absolute top-1/2 -translate-y-1/2 right-0 p-2 me-2"
                    >
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>

            <div class="form-group mb-8">
                <label for="description" class="label w-32">{{ __("Description") }}:</label>
                <textarea
                    name="description" id="description" class="input"
                    placeholder="{{ __("Classroom's description") }}"
                >{!! old("description") !!}</textarea>
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
