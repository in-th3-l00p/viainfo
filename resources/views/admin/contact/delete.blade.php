@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Remove contact submission')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.contact.index'), 'name' => __('Contact submissions')],
            [ 'name' => __('Remove contact submission') ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("Are you sure you want to remove contact submission") }}?
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.contact.destroy", [
                "contact" => $contact,
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
