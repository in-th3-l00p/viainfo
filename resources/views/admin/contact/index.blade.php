@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Contact submissions')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Contact submissions')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("All of the contact submissions sent through the contact form") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div class="mb-16">
            <h2 class="mb-2">{{ __("Notification receivers") }}:</h2>
            <x-admin.operations.container class="mb-4">
                <x-admin.operations.route
                    :title="__('Add a contact notification receivers')"
                    :href="route('admin.contact.receivers.create')"
                    icon="fa-plus"
                />
            </x-admin.operations.container>

            @if ($receivers->count() > 0)
                <ul role="list" class="divide-y divide-gray-100 rounded-md shadow-md">
                    @foreach ($receivers as $receiver)
                        <li @class([
                            "flex justify-between gap-x-6 py-5 bg-white px-8",
                            "rounded-t-md" => $loop->first,
                            "rounded-b-md" => $loop->last,
                        ])>
                            <div class="flex min-w-0 gap-x-4">
                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                                     src="/static/pfp.png"
                                     alt="pfp">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        @if ($receiver->user_id)
                                            {{ $receiver->user->name }}
                                        @else
                                            {{ $receiver->name }}
                                        @endif
                                    </p>
                                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                        @if ($receiver->user_id)
                                            {{ $receiver->user->email }}
                                        @else
                                            {{ $receiver->email }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-x-6">
                                <div
                                    x-data="{ dropdownOpen: false }"
                                    class="relative flex-none"
                                >
                                    <button
                                        type="button"
                                        class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900"
                                        id="options-menu-0-button"
                                        aria-expanded="false"
                                        aria-haspopup="true"
                                        @click="dropdownOpen = !dropdownOpen"
                                    >
                                        <span class="sr-only">Open options</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"/>
                                        </svg>
                                    </button>

                                    <div
                                        class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none transition-all"
                                        role="menu"
                                        aria-orientation="vertical"
                                        aria-labelledby="options-menu-0-button"
                                        tabindex="-1"
                                        x-bind:class="dropdownOpen ? 'opacity-100 scale-100' : 'opacity-0 scale-95' "
                                        x-show="dropdownOpen"
                                    >
                                        <a
                                            class="w-full block text-center px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="options-menu-0-item-0"
                                            title="{{ __("Remove") }}"
                                            href="{{ route("admin.contact.receivers.delete", [
                                                "receiver" => $receiver
                                            ]) }}"
                                        >
                                            {{ __("Remove") }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="empty-text">{{ __("No notification receivers") }}</p>
            @endif
        </div>

        <div
            class="flex flex-col mb-8"
        >
            <h2 class="mb-2">{{ __("Submissions") }}:</h2>
            <div>
                <x-admin.operations.container class="mb-4">
                    <x-admin.operations.route
                        :title="__('Classrooms trash')"
                        :href="route('admin.contact.trash')"
                        icon="fa-trash"
                    />
                </x-admin.operations.container>
            </div>

            @forelse($contacts as $submission)
                <div
                    @class([
                        "w-full",
                        "bg-white p-8 rounded-md shadow-md flex flex-col gap-4",
                        "hover:scale-105 hover:shadow-lg transition-all mb-8"
                    ])
                >
                    <div class="flex flex-col md:flex-row justify-between gap-8">
                        <div class="w-full">
                            <h2 class="text-xl font-bold">
                                {{ $submission->first_name }} {{ $submission->last_name }}
                            </h2>
                            <p>{{ $submission->created_at }}</p>
                            <p>{{ $submission->email }}</p>
                            <p>{{ $submission->phone }}</p>

                            <p class="mt-4 break-all">
                                @if (strlen($submission->message) > 100)
                                    {{ substr($submission->message, 0, 100) }}...
                                @else
                                    {{ $submission->message }}
                                @endif
                            </p>
                        </div>

                        <div class="flex flex-col gap-4">
                            <a
                                href="{{ route('admin.contact.show', $submission) }}"
                                class="btn btn-primary"
                                title="{{ __("Show") }}"
                            >
                                {{ __("Show") }}
                            </a>
                            <a
                                href="{{ route('admin.contact.delete', $submission) }}"
                                class="btn btn-primary"
                                title="{{ __("Delete") }}"
                            >
                                {{ __("Delete") }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-text">
                    {{ __("There are no submissions sent") }}
                </div>
            @endforelse
        </div>
    </x-layout>
@endsection
