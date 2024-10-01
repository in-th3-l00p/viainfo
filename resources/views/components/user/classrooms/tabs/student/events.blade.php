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
        </div>
    @empty
        <p class="empty-text">
            {{ __("No events found.") }}
        </p>
    @endforelse
</section>
