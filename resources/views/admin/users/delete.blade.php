@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Delete user') . ' \'\'' . $user->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Delete') . ' \'\'' . $user->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Are you sure you want to delete user") }}: {{ $user->name }}?
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.users.destroy", [ "user" => $user ]) }}"
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
