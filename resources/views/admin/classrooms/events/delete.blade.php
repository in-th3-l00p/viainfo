@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Remove event') . ' \'\'' . $event->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.classrooms.index'), 'name' => __('Classrooms') ],
            [
                'href' => route('admin.classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Classroom') . ' \'\'' . $classroom->name . '\'\''
            ],
            [ 'name' => __('Delete event') . ' \'\'' . $event->name . '\'\'' ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("Are you sure you want to remove event") }} "<span class="font-semibold">{{ $event->name }}</span>" {{ __("?") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.classrooms.events.destroy", [
                "classroom" => $classroom,
                "event" => $event
            ]) }}"
        >
            @csrf
            @method("DELETE")

            <div class="flex gap-4">
                <button type="submit" class="btn">
                    {{ __("Yes") }}
                </button>

                <a href="{{ url()->previous() }}" class="btn">
                    {{ __("No") }}
                </a>
            </div>
        </form>
    </x-layout>
@endsection
