@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Classrooms')"
        :breadcrumbPath="[
            [ 'href' => route('user.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Classrooms')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Access all your classrooms") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div
            class="flex flex-col mb-8"
        >
            @if (request()->user()->classroomInvitations->count() > 0)
                <h2 class="mb-2">{{ __("Invitations") }}</h2>
            @endif
            @foreach(request()->user()->classroomInvitations as $classroom)
                <x-user.classrooms.classroom-display
                    :classroom="$classroom"
                >
                    <div class="flex gap-4">
                        <form
                            method="post"
                            action="{{ route("classrooms.invitations.accept", [
                                "classroom" => $classroom
                            ]) }}"
                        >
                            @csrf

                            <button
                                title="{{ __("Open classroom") }}"
                                class="btn"
                            >
                                Accept
                            </button>
                        </form>
                        <form
                            method="post"
                            action="{{ route("classrooms.invitations.reject", [
                                "classroom" => $classroom
                            ]) }}"
                        >
                            @csrf
                            @method("DELETE")

                            <button
                                type="submit"
                                title="{{ __("Open classroom") }}"
                                class="btn"
                            >
                                Reject
                            </button>
                        </form>

                    </div>
                </x-user.classrooms.classroom-display>
            @endforeach

            <h2 class="mb-2">{{ __("Your classrooms") }}</h2>
            @forelse($classrooms as $classroom)
                <x-user.classrooms.classroom-display
                    :classroom="$classroom"
                >
                    <a
                        title="{{ __("Open classroom") }}"
                        href="{{ route("classrooms.show", [
                            "classroom" => $classroom
                        ]) }}"
                        class="btn"
                    >
                        <i class="fa-solid fa-eye"></i>
                        Open
                    </a>
                </x-user.classrooms.classroom-display>
            @empty
                <div class="empty-text">
                    {{ __("You are not part of any classroom") }}
                </div>
            @endforelse
        </div>

        {{ $classrooms->links() }}
    </x-layout>
@endsection
