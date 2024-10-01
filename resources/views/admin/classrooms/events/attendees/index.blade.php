@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Remove event') . ' \'\'' . $event->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.classrooms.index'), 'name' => __('Classrooms') ],
            [
                'href' => route('admin.classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Classroom') . ' \'\'' . $classroom->name . '\'\''
            ],
            [
                'href' => route('admin.classrooms.show', [
                    'classroom' => $classroom
                ]),
                'name' => __('Event') . ' \'\'' . $event->name . '\'\''
            ],
            [
                'name' => 'Attendees'
            ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("Event") }} "<span class="font-semibold">{{ $event->name }}</span>" {{ __("attendees") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        @if ($classroom->students()->count() > 0)
            <ul role="list" class="divide-y divide-gray-100 rounded-md shadow-md">
                @foreach ($classroom->students as $user)
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
                                    {{ $user->name }}
                                </p>
                                <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                        <div class="flex shrink-0 items-center gap-x-6">
                            @if (!$event->attendances->contains($user))
                                <form
                                    action="{{ route('admin.classrooms.events.attendees.mark-as-attended', [
                                        'classroom' => $classroom,
                                        'event' => $event,
                                        'user' => $user
                                    ]) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn"
                                        title="{{ __('Mark as attended') }}"
                                    >
                                        {{ __("Mark as attended") }}
                                    </button>
                                </form>
                            @else
                                <form
                                    action="{{ route('admin.classrooms.events.attendees.mark-as-not-attended', [
                                        'classroom' => $classroom,
                                        'event' => $event,
                                        'user' => $user
                                    ]) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method("DELETE")

                                    <button
                                        type="submit"
                                        class="btn"
                                        title="{{ __('Mark as not attended') }}"
                                    >
                                        {{ __("Mark as not attended") }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="empty-text">{{ __("No students in this classroom") }}</p>
        @endif
    </x-layout>
@endsection
