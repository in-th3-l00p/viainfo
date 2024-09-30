@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Test projects trash')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.classrooms.index'), 'name' => __('Classrooms') ],
            [ 'name' => __('Trash')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("See and restore deleted classrooms") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <section
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-8"
        >
            @forelse($classrooms as $classroom)
                <div
                    type="button"
                    @class([
                        "h-96 max-w-96",
                        "bg-white p-8 rounded-md shadow-md flex flex-col gap-4",
                        "hover:scale-105 hover:shadow-lg transition-all"
                    ])
                >
                    @if ($classroom->tags()->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach ($classroom->tags()->get() as $tag)
                                <div class="tag-disabled">{{ $tag->name }}</div>
                            @endforeach
                        </div>
                    @endif

                    <h2 class="text-xl font-bold mb-4">{{ $classroom->name }}</h2>
                    <div class="mb-auto h-18 overflow-hidden line-clamp-3 text-ellipsis">
                        {!! $classroom->description !!}
                    </div>

                    <div class="flex gap-4">
                        <form
                            method="post"
                            action="{{ route("admin.classrooms.restore", [
                                "classroom" => $classroom
                            ]) }}"
                        >
                            @csrf
                            @method("PUT")

                            <button
                                type="submit"
                                title="{{ __("Restore classroom") }}"
                                class="btn"
                            >
                                Restore
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div @class([
                    "sm:col-span-2 md:col-span-3 lg:col-span-4",
                    "text-center text-zinc-600 text-lg"
                ])>
                    {{ __("No classrooms found.") }}
                </div>
            @endforelse
        </section>

        {{ $classrooms->links() }}
    </x-layout>
@endsection
