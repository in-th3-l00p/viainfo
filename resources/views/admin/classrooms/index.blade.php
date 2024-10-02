@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Classrooms')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Classrooms')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Manage classrooms") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div>
            <x-admin.operations.container class="mb-4">
                <x-admin.operations.route
                    :title="__('Create classroom')"
                    :href="route('admin.classrooms.create')"
                    icon="fa-plus"
                />
                <x-admin.operations.route
                    :title="__('Classrooms trash')"
                    :href="route('admin.classrooms.trash')"
                    icon="fa-trash"
                />
            </x-admin.operations.container>

            <section
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-8"
            >
                @forelse($classrooms as $classroom)
                    @php
                        $role = request()->user()->role;
                    @endphp

                    <div
                        @class([
                            "h-96 max-w-96 w-full",
                            "bg-white p-8 rounded-md shadow-md flex flex-col gap-4",
                            "hover:scale-105 hover:shadow-lg transition-all"
                        ])
                    >
                        @if ($classroom->tags()->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($testProject->tags()->get() as $tag)
                                    <a
                                        href="{{ route($role . ".tags.show", [
                                            "tag" => $tag
                                        ]) }}"
                                        class="tag"
                                    >
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <h2 class="text-xl font-bold">{{ $classroom->name }}</h2>
                        <div class="mb-auto h-18 overflow-hidden line-clamp-3 text-ellipsis">
                            {!! $classroom->description !!}
                        </div>

                        <div class="flex gap-4">
                            <a
                                title="{{ __("Open classroom") }}"
                                href="{{ route($role . ".classrooms.show", [
                                    "classroom" => $classroom
                                ]) }}"
                                class="btn"
                            >
                                <i class="fa-solid fa-eye"></i>
                                Open
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 empty-text">
                        {{ __("No classrooms found.") }}
                    </div>
                @endforelse
            </section>

            {{ $classrooms->links() }}
        </div>
    </x-layout>
@endsection
