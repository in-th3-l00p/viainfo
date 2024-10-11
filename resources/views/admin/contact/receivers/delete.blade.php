@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Remove contact notification receiver') . ' \'\'' . ($receiver->user_id ? $receiver->user->name : $receiver->name) . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.contact.index'), 'name' => __('Contact submissions')],
            [ 'name' => __('Remove receiver') ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("Are you sure you want to remove contact notification receiver") }} "<span class="font-semibold">{{ ($receiver->user_id ? $receiver->user->name : $receiver->name) }}</span>" {{ __("?") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.contact.receivers.destroy", [
                "receiver" => $receiver->id,
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
