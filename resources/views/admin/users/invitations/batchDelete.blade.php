@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Delete user invitations')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'href' => route('admin.users.invitations.index'), 'name' => __('User Invitations') ],
            [ 'name' => __('Delete user invitations')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Are you sure you want to delete") }} {{ sizeof($invitations) }} {{ __("user invitations") }}?
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.users.invitations.batchDestroy") }}"
        >
            @csrf
            @method("DELETE")

            @foreach($invitations as $invitation)
                <input
                    type="hidden"
                    id="invitation-{{ $invitation->id }}"
                    name="invitations[]"
                    value="{{ $invitation->id }}"
                >
            @endforeach

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
