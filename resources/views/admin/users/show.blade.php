@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('User') . ' ' . $user->name"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Profile of ') . ' \'\'' . $user->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("User profile page") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div class="mb-4">
            <p>{{ __("Name") }}: {{ $user->name }}</p>
            <p>{{ __(" Email") }}: {{ $user->email }}</p>
            <p>{{ __(" Created at") }}: {{ $user->created_at }}</p>
            <p>{{ __(" Updated at") }}: {{ $user->updated_at }}</p>
        </div>

        <div class="flex items-center gap-2">
            <a
                title="{{ __("Edit user") }}"
                href="{{ route("admin.users.edit", [ "user" => $user ]) }}"
                class="icon-btn"
            >
                <i class="fa-solid fa-pen-to-square"></i>
            </a>

            <x-admin.users.delete-button :user="$user" />
        </div>
    </x-layout>
@endsection
