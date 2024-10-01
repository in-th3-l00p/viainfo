@php use Carbon\Carbon; @endphp
<section x-show="tab === 'events'">
    <x-admin.operations.container class="mb-8">
        <a
            href="{{ route(
                "admin.classrooms.events.create",
                [ "classroom" => $classroom ]
            ) }}"
            class="icon-btn"
            title={{ __("Add") }}
        >
            <i class="fas fa-plus"></i>
        </a>
    </x-admin.operations.container>

    @forelse ($classroom->events as $event)
        <div
            @class([
                "w-full",
                "bg-white p-8 rounded-md shadow-md",
                "hover:scale-105 hover:shadow-lg transition-all mb-8",
                "flex flex-wrap justify-between gap-8"
            ])
        >
            <div>
                <h2 class="text-xl font-bold mb-4">{{ $event->name }}</h2>
                @if ($event->start)
                    <p class="text-zinc-500">
                        {{ __("Starts at:") }}
                        {{ Carbon::create($event->start)->format("Y-m-d H:i") }}
                    </p>
                @endif
                @if ($event->end)
                    <p class="text-zinc-500">
                        {{ __("Ends at:") }}
                        {{ Carbon::create($event->end)->format("Y-m-d H:i") }}
                    </p>
                @endif

                <div class="mt-4">
                    {!! $event->description !!}
                </div>
            </div>
            <div>
                <a
                    href="{{ route(
                        "admin.classrooms.events.attendees.index",
                        [ "classroom" => $classroom, "event" => $event ]
                    ) }}"
                    class="btn mb-4"
                    title={{ __("Attendees") }}
                >
                    <i class="fas fa-user"></i>
                    {{ __("Attendees") }}
                </a>

                <a
                    href="{{ route(
                        "admin.classrooms.events.edit",
                        [ "classroom" => $classroom, "event" => $event ]
                    ) }}"
                    class="btn mb-4"
                    title={{ __("Edit") }}
                >
                    <i class="fas fa-edit"></i>
                    {{ __("Edit") }}
                </a>

                <a
                    class="btn"
                    title="{{ __("Delete") }}"
                    href="{{ route("admin.classrooms.events.delete", [
                        "classroom" => $classroom,
                        "event" => $event
                    ]) }}"
                >
                    <i class="fas fa-trash"></i>
                    {{ __("Delete") }}
                </a>
        </div>
    @empty
        <p class="empty-text">
            {{ __("No events found.") }}
        </p>
    @endforelse
</section>
