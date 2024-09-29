<section
    x-show="tab === 'people'"
    x-data="{ inviteModalOpened: $persist(false) }"
>
    @livewire("admin.classrooms.invite-modal", [
        "classroom" => $classroom
    ])
    <x-admin.operations.container class="mb-8">
        <button
            type="button"
            class="icon-btn"
            title={{ __("Add") }}
                        @click="inviteModalOpened = true"
        >
        <i class="fas fa-plus"></i>
        </button>
    </x-admin.operations.container>

    @livewire("admin.classrooms.invited-users", [
        "classroom" => $classroom
    ])

    <h2>{{ __("People") }}</h2>
    @if ($classroom->users()->count() > 0)
        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($classroom->users as $user)
                <li class="flex justify-between gap-x-6 py-5">
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
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">{{ __(ucfirst($user->classroomRole)) }}</p>
{{--                            <p class="mt-1 text-xs leading-5 text-gray-500">Last seen--}}
{{--                                <time datetime="2023-01-23T13:23Z">3h ago</time>--}}
{{--                            </p>--}}
                        </div>
                        <div
                            x-data="{ dropdownOpen: false }"
                            class="relative flex-none"
                        >
                            <button
                                type="button"
                                class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900"
                                id="options-menu-0-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                                @click="dropdownOpen = !dropdownOpen"
                            >
                                <span class="sr-only">Open options</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"/>
                                </svg>
                            </button>

                            <div
                                class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none transition-all"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="options-menu-0-button"
                                tabindex="-1"
                                x-bind:class="dropdownOpen ? 'opacity-100 scale-100' : 'opacity-0 scale-95' "
                                x-show="dropdownOpen"
                            >
                                <form
                                    action="{{ route("admin.classrooms.users.update", [
                                        "classroom" => $classroom,
                                        "user" => $user
                                    ]) }}"
                                    method="post"
                                >
                                    @csrf
                                    @method("PUT")

                                    <input type="hidden" name="role" value="{{ $user->classroomRole === "student" ? "teacher" : "student" }}">

                                    <button
                                        type="submit"
                                        class="block text-center px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                        role="menuitem"
                                        tabindex="-1"
                                        id="options-menu-0-item-0"
                                        title="{{ __("Make him") . " " . ($user->classroomRule === "student" ? __("Teacher") : __("Student")) }}"
                                    >
                                        {{ __("Make him") . " " . ($user->classroomRole === "student" ? __("Teacher") : __("Student")) }}<span class="sr-only">, {{ $user->name }}</span>
                                    </button>
                                </form>

                                <a
                                    href="{{ route('admin.classrooms.users.delete', [
                                        'classroom' => $classroom,
                                        'user' => $user
                                    ]) }}"
                                    class="block text-center px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="options-menu-0-item-0"
                                    title="{{ __("Remove") }}"
                                >
                                    {{ __("Remove") }}<span class="sr-only">, {{ $user->name }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="empty-text">{{ __("No people in this classroom") }}</p>
    @endif
</section>
