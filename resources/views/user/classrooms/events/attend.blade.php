@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Attend at event') . ' \'\'' . $event->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('user.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('classrooms.index'), 'name' => __('Classrooms') ],
            [
                'href' => route('classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Classroom') . ' \'\'' . $classroom->name . '\'\''
            ],
            [
                'href' => route('classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Event') . ' \'\'' . $event->name . '\'\''
            ],
            [
                'name' => 'Attend at event \'\'' . $event->name . '\'\''
            ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("Enter event") }} "<span class="font-semibold">{{ $event->name }}</span>" {{ __("attend code.") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route('classrooms.events.attend', [
                'classroom' => $classroom,
                'event' => $event
            ]) }}"
            method="POST"
            class="max-w-xl"
        >
            @csrf

            <div class="mb-8">
                <div class="form-group">
                    <label
                        for="attend_code"
                        class="form-label w-32"
                    >
                        {{ __("Attend code") }}:
                    </label>
                    <input
                        type="text"
                        id="attend_code"
                        name="attend_code"
                        class="input @error('attend_code') border-red-500 @enderror"
                        placeholder="{{ __("Enter the event attend code") }}"
                        required
                    >
                </div>
                @error('attend_code')
                <p class="text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Attend") }}"
            >
                {{ __("Attend") }}
            </button>
        </form>
    </x-layout>
@endsection

