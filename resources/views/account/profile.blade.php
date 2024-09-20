@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('User') . ' \'\'' . request()->user()->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route(request()->user()->role . '.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Account') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Profile page") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div class="mb-4">
            <p>{{ __("Name") }}: {{ request()->user()->name }}</p>
            <p>{{ __(" Email") }}: {{ request()->user()->email }}</p>
            <p>{{ __(" Created at") }}: {{ request()->user()->created_at }}</p>
            <p>{{ __(" Updated at") }}: {{ request()->user()->updated_at }}</p>
        </div>

        <div class="flex items-center gap-2">
            <a
                title="{{ __("Edit") }}"
                href="{{ route("account.edit") }}"
                class="icon-btn"
            >
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a
                title="{{ __("Change password") }}"
                href="{{ route("account.password") }}"
                class="icon-btn"
            >
                <i class="fa-solid fa-key"></i>
            </a>
        </div>
    </x-layout>
@endsection
