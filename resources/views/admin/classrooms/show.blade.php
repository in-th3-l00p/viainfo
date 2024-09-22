@extends("layouts.main")

<!-- todo issue with generateSlug function have no idea why !-->
@push("vite")
    @vite([ "resources/js/admin/classrooms/create.js" ])
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
            <section x-show="tab === 'people'">
                <h2 class="section-title">{{ __("People") }}</h2>

                <x-admin.operations.container>
                    <button
                        type="button"
                        class="icon-btn"
                        title={{ __("Add") }}
                    >
                        <i class="fas fa-plus"></i>
                    </button>
                </x-admin.operations.container>

                @if ($classroom->users()->count() > 0)
                    <ul role="list" class="divide-y divide-gray-100">
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                     src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                     alt="">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        <a href="#" class="hover:underline">Leslie Alexander</a>
                                    </p>
                                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                        <a href="mailto:leslie.alexander@example.com" class="truncate hover:underline">leslie.alexander@example.com</a>
                                    </p>
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-x-6">
                                <div class="hidden sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">Co-Founder / CEO</p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">Last seen
                                        <time datetime="2023-01-23T13:23Z">3h ago</time>
                                    </p>
                                </div>
                                <div class="relative flex-none">
                                    <button type="button" class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900"
                                            id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open options</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"/>
                                        </svg>
                                    </button>

                                    <!--
                                    Dropdown menu, show/hide based on menu state.

                                    Entering: "transition ease-out duration-100"
                                    From: "transform opacity-0 scale-95"
                                    To: "transform opacity-100 scale-100"
                                    Leaving: "transition ease-in duration-75"
                                    From: "transform opacity-100 scale-100"
                                    To: "transform opacity-0 scale-95"
                                    -->
                                    <div
                                        class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-50", Not Active: "" -->
                                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                           role="menuitem" tabindex="-1" id="options-menu-0-item-0">View profile<span
                                                class="sr-only">, Leslie Alexander</span></a>
                                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                           role="menuitem" tabindex="-1" id="options-menu-0-item-1">Message<span
                                                class="sr-only">, Leslie Alexander</span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @else
                    <p class="empty-text">{{ __("No people in this classroom") }}</p>
                @endif
            </section>
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
