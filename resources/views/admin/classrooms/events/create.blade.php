@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Create classroom event')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.classrooms.index'), 'name' => __('Classrooms') ],
            [
                'href' => route('admin.classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Classroom') . ' \'\'' . $classroom->name . '\'\''
            ],
            [ 'name' => __('Create event ') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Complete the fields related to the classroom event's data") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.classrooms.events.store", [
                "classroom" => $classroom
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to create this event')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Event's name") }}"
                    value="{{ old("name") }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="description" class="label w-32">{{ __("Description") }}:</label>
                <textarea
                    name="description" id="description" class="input"
                    placeholder="{{ __("Event's description") }}"
                >{{ old("description") }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="start" class="label w-32">{{ __("Start") }}:</label>
                <input
                    type="datetime-local" name="start" id="start"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Event's start date") }}"
                    value="{{ old("start") }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="end" class="label w-32">{{ __("End") }}:</label>
                <input
                    type="datetime-local" name="end" id="end"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Event's end date") }}"
                    value="{{ old("end") }}"
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
