<div
    type="button"
    @class([
        "h-96 max-w-96",
        "bg-white p-8 rounded-md shadow-md flex flex-col gap-4",
        "hover:scale-105 hover:shadow-lg transition-all"
    ])
>
    @if ($testProject->tags()->count() > 0)
        <div class="flex flex-wrap gap-2">
            @foreach ($testProject->tags()->get() as $tag)
                <div class="tag-disabled">{{ $tag->name }}</div>
            @endforeach
        </div>
    @endif

    <h2 class="text-xl font-bold mb-4">{{ $testProject->title }}</h2>
    <div class="mb-auto h-18 overflow-hidden line-clamp-3 text-ellipsis">
        {!! $testProject->description !!}
    </div>

    <div class="flex gap-4">
        <form
            method="post"
            action="{{ route("admin.test-projects.restore", [
                "test_project" => $testProject
            ]) }}"
        >
            @csrf
            @method("PUT")

            <button
                type="submit"
                title="{{ __("Restore test project") }}"
                class="btn"
            >
                Restore
            </button>
        </form>
    </div>
</div>
