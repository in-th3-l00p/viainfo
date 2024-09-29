@extends("layouts.main")

<!-- todo issue with generateSlug function have no idea why !-->
@push("vite")
    @vite([
        "resources/js/admin/classrooms/create.js"
    ])
@endpush

@section("content")
    <x-layout
        :title="__('Classroom') . ' ' . $classroom->name"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.classrooms.index'), 'name' => __('Classrooms') ],
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
            <x-admin.classrooms.tabs/>
            <x-admin.classrooms.tabs.people :classroom="$classroom" />
            <section
                class="mb-16 bg-white rounded-md p-8 shadow-md"
                x-show="tab === 'settings'"
            >
                <h2 class="section-title">{{ __("Settings") }}</h2>
                <div class="ml-4 space-y-4">
                    <x-admin.classrooms.tags :classroom="$classroom"/>
                    <x-admin.classrooms.edit :classroom="$classroom"/>
                </div>
            </section>
        </div>
    </x-layout>
@endsection
