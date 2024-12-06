@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('User Invitations')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('User Invitations')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("All of the user invitations sent through the email") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        @if ($errors->any())
            <div class="mb-16">
                <x-admin.errors-alert
                    :text="__('the following errors occurred when trying to create this user invitation')"
                    :errors="$errors"
                />
            </div>
        @endif

        <div
            class="mb-16"
            x-data="{ selected: [] }"
        >
            <x-admin.operations.container class="mb-4">
                <x-admin.operations.route
                    :title="__('Add a user invitation')"
                    :href="route('admin.users.invitations.create')"
                    icon="fa-plus"
                />

                <button
                    type="button"
                    class="icon-btn"
                    title="{{ __("Select all") }}"
                    @click="selected.length !== {{ $invitations->count() }} ? selected = [ {{ $invitations->pluck('id')->join(", ") }} ] : selected = []"
                >
                    <i class="fa-solid fa-check-square"></i>
                </button>

                <template x-if="selected.length > 0">
                    <form action="{{ route("admin.users.invitations.batchDelete") }}">
                        <template x-for="id in selected">
                            <input
                                type="hidden"
                                x-bind:id="'invitations-' + id"
                                name="invitations[]"
                                x-bind:value="id"
                            >
                        </template>

                        <button
                            type="submit"
                            class="icon-btn ms-4"
                            title="{{ __("Delete selected") }}"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>


                </template>

                <template x-if="selected.length > 0">
                    <form
                        method="post"
                        action="{{ route("admin.users.invitations.send.batch") }}"
                    >
                        @csrf

                        <template x-for="id in selected">
                            <input
                                type="hidden"
                                x-bind:id="'invitations-' + id"
                                name="invitations[]"
                                x-bind:value="id"
                            >
                        </template>

                        <button
                            type="submit"
                            class="icon-btn"
                            title="{{ __("Send selected") }}"
                        >
                            <i class="fa-solid fa-envelope"></i>
                        </button>
                    </form>
                </template>
            </x-admin.operations.container>

            @if ($invitations->count() > 0)
                <ul role="list" class="divide-y divide-gray-100 rounded-md shadow-md">
                    @foreach ($invitations as $invitation)
                        <li @class([
                            "flex justify-between gap-x-6 py-5 bg-white px-8",
                            "rounded-t-md" => $loop->first,
                            "rounded-b-md" => $loop->last,
                        ])>
                            <div class="flex min-w-0 gap-x-4 items-center gap-4">
                                <input
                                    type="checkbox"
                                    class="rounded-md"
                                    @click="selected.includes({{ $invitation->id }}) ? selected = selected.filter(id => id !== {{ $invitation->id }}) : selected.push({{ $invitation->id }})"
                                    x-bind:checked="selected.includes({{ $invitation->id }})"
                                >

                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        {{ $invitation->name }}
                                    </p>
                                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                        {{ $invitation->email }}
                                    </p>
                                    @if ($invitation->classroom_name)
                                        <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                            {{ $invitation->classroom_name }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-x-6">
                                @if ($invitation->sent)
                                    <p class="text-green-600">{{ __("Sent") }}</p>
                                @else
                                    <p class="text-red-600">{{ __("Unsent") }}</p>
                                @endif


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
                                            <form
                                                method="post"
                                                action="{{ route("admin.users.invitations.send", [ "invitation" => $invitation ]) }}"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="w-full block text-center px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                                    role="menuitem"
                                                    tabindex="-1"
                                                    id="options-menu-0-item-0"
                                                    @if ($invitation->sent)
                                                        title="{{ __("Resend") }}"
                                                    @else
                                                        title="{{ __("Send") }}"
                                                    @endif
                                                >
                                                    @if ($invitation->sent)
                                                        {{ __("Resend") }}
                                                    @else
                                                        {{ __("Send") }}
                                                    @endif
                                                </button>
                                            </form>
                                            <a
                                                class="w-full block text-center px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                                role="menuitem"
                                                tabindex="-1"
                                                id="options-menu-0-item-0"
                                                title="{{ __("Remove") }}"
                                                href="{{ route("admin.users.invitations.delete", [
                                                    "invitation" => $invitation
                                                ]) }}"
                                            >
                                                {{ __("Remove") }}
                                            </a>
                                            <button
                                                type="button"
                                                class="w-full block text-center px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                                role="menuitem"
                                                tabindex="-1"
                                                id="copy-link-button"
                                                @click="navigator.clipboard.writeText('{{ route("invitation.create", [ "token" => $invitation->token ]) }}').then(() => { dropdownOpen = false; })"
                                            >
                                                {{ __("Copy Link") }}
                                            </button>
                                        </div>
                                    </div>                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="empty-text">{{ __("No user invitations") }}</p>
            @endif
        </div>
    </x-layout>
@endsection
