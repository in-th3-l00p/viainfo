@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Attend code for event') . ' \'\'' . $event->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.classrooms.index'), 'name' => __('Classrooms') ],
            [
                'href' => route('admin.classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Classroom') . ' \'\'' . $classroom->name . '\'\''
            ],
            [
                'href' => route('admin.classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Event') . ' \'\'' . $event->name . '\'\''
            ],
            [
                'name' => 'Attend code'
            ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("Event") }} "<span class="font-semibold">{{ $event->name }}</span>" {{ __("attend code.") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <h2 class="text-5xl font-semibold mb-4">
            {{ $event->attend_code }}
        </h2>
    </x-layout>
@endsection
