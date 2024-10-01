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
            [ 'name' => __('Edit event ') . '\'\'' . $event->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Complete the fields related to the classroom event's data") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.classrooms.events.update", [
                "classroom" => $classroom,
                "event" => $event
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf
            @method("PUT")

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to update this event')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Event's name") }}"
                    value="{{ $event->name }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="description" class="label w-32">{{ __("Description") }}:</label>
                <textarea
                    name="description" id="description" class="input"
                    placeholder="{{ __("Event's description") }}"
                >{{ $event->description }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="start" class="label w-32">{{ __("Start") }}:</label>
                <input
                    type="datetime-local" name="start" id="start"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("start")])
                    placeholder="{{ __("Event's start date") }}"
                    value="{{ $event->start }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="end" class="label w-32">{{ __("End") }}:</label>
                <input
                    type="datetime-local" name="end" id="end"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("end")])
                    placeholder="{{ __("Event's end date") }}"
                    value="{{ $event->end }}"
                >
            </div>
            <div class="form-group mb-8">
                <label for="self_attend" class="label w-32">{{ __("Self attend") }}:</label>
                <input
                    type="checkbox" name="self_attend" id="self_attend"
                    class="rounded-md scale-150"
                    placeholder="{{ __("Event's self attend functionality") }}"
                    @checked($event->self_attend)
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
