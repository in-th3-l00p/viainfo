<div
    @class([
        "w-full",
        "bg-white p-8 rounded-md shadow-md flex flex-col gap-4",
        "hover:scale-105 hover:shadow-lg transition-all mb-8"
    ])
>
    <div class="flex flex-wrap justify-between gap-8">
        <div>
            <h2 class="text-xl font-bold">{{ $classroom->name }}</h2>
            <div class="mb-auto h-18 overflow-hidden line-clamp-3 text-ellipsis">
                {!! $classroom->description !!}
            </div>
        </div>

        {{ $slot }}
    </div>
</div>
