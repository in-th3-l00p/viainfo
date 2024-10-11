@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Contact submission trash')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.contact.index'), 'name' => __('Contact submissions')],
            [ 'name' => __('Contact submission trash') ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("See or restore deleted contact submissions") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

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
                            href="{{ route('admin.contact.show', [
                                "contact" => $submission
                            ]) }}"
                            class="btn btn-primary"
                            title="{{ __("Show") }}"
                        >
                            {{ __("Show") }}
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.contact.restore', [
                                "contact" => $submission
                            ]) }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-primary"
                                title="{{ __("Restore") }}"
                            >
                                {{ __("Restore") }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-text">
                {{ __("There are no submissions sent") }}
            </div>
        @endforelse

        {{ $contacts->links() }}
    </x-layout>
@endsection
