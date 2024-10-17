@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Delete user invitation') . ' \'\'' . $invitation->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'href' => route('admin.users.invitations.index'), 'name' => __('User Invitations') ],
            [ 'name' => __('Delete user invitation') . ' \'\'' . $invitation->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Are you sure you want to delete user invitation") }}: {{ $invitation->name }}?
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.users.invitations.destroy", [
                "invitation" => $invitation
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
