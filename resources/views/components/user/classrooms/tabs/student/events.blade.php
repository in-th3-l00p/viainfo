@php use Carbon\Carbon; @endphp
<section x-show="tab === 'events'">
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
                <h2 class="text-xl font-bold">{{ $event->name }}</h2>
                <p class="mb-4">{{ $event->owner->name }}</p>
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

            <div class="flex flex col items-center justify-center gap-4">
                @if ($event->self_attend && Carbon::now()->between(Carbon::create($event->start), Carbon::create($event->end)))
                    @if ($event->attendances->contains(auth()->user()))
                        <form
                            method="post"
                            action="{{ route("classrooms.events.unattend", [
                                "classroom" => $classroom,
                                "event" => $event
                            ]) }}"
                        >
                            @csrf
                            @method("DELETE")

                            <button
                                type="submit"
                                title="{{ __("Unattended") }}"
                                class="btn"
                            >
                                {{ __("Unattended") }}
                            </button>
                        </form>
                    @else
                        <a
                            href="{{ route("classrooms.events.attend-code", [
                                "classroom" => $classroom,
                                "event" => $event
                            ]) }}"
                            title="{{ __("Attend") }}"
                            class="btn"
                        >
                            {{ __("Attend") }}
                        </a>
                    @endif
                @else
                    <p>
                        {{ $event->attendances->contains(auth()->user()) ?
                            __("Attended") :
                            __("Unattended")
                        }}
                    </p>
                @endif
            </div>
        </div>
    @empty
        <p class="empty-text">
            {{ __("No events found.") }}
        </p>
    @endforelse

    {{ $events->links() }}
</section>
