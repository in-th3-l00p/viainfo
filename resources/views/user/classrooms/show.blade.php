@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Classroom') . ' ' . $classroom->name"
        :breadcrumbPath="[
            [ 'href' => route('user.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('classrooms.index'), 'name' => __('Classrooms') ],
            [ 'name' => __('Classroom') . ' \'\'' . $classroom->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {!! $classroom->description !!}
            </x-ui.layout.subtitle>
            @if ($classroom->visibility === "private")
                <p class="font-semibold mb-4">{{ __("Private") }}</p>
            @endif
        </x-slot:subtitle>

        <!-- tab system !-->
        <div x-data="{ tab: $persist('feed') }">
            <x-user.classrooms.tabs/>
            <x-user.classrooms.tabs.student.people :classroom="$classroom" />
        </div>
    </x-layout>
@endsection
