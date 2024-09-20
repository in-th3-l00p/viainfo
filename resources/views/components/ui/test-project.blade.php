@php
    $role = request()->user()->role;
@endphp

<div
    @class([
        "h-96 max-w-96",
        "bg-white p-8 rounded-md shadow-md flex flex-col gap-4",
        "hover:scale-105 hover:shadow-lg transition-all"
    ])
>
    @if ($testProject->tags()->count() > 0)
        <div class="flex flex-wrap gap-2">
            @foreach ($testProject->tags()->get() as $tag)
                <a
                    href="{{ route($role . ".tags.show", [
                        "tag" => $tag
                    ]) }}"
                    class="tag"
                >
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    @endif

    <h2 class="text-xl font-bold">{{ $testProject->title }}</h2>
    <div class="mb-auto h-18 overflow-hidden line-clamp-3 text-ellipsis">
        {!! $testProject->description !!}
    </div>

    <div class="flex gap-4">
        <a
            title="{{ __("Open test project") }}"
            href="{{ route($role . ".test-projects.show", [
                "test_project" => $testProject
            ]) }}"
            class="btn"
        >
            <i class="fa-solid fa-eye"></i>
            Open
        </a>

        @if (isset($buttons))
            {{ $buttons }}
        @endif
    </div>
</div>
