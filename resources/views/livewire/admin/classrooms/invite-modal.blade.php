<div
    x-bind:class="inviteModalOpened ? 'opacity-100' : 'opacity-0 hidden'"
    @class([
        "invite-modal",
        "fixed top-0 left-0 w-screen h-screen z-50",
        "bg-black bg-opacity-50",
        "flex justify-center items-center",
        "transition-all"
    ])
>
    <form
        @class([
            "bg-white p-8 rounded-md shadow-md w-full max-w-xl",
            "flex flex-col justify-between gap-4",
        ])
        wire:submit.prevent="invite"
    >
        <div>
            <div class="flex items-center justify-between gap-8">
                <h2 class="section-title !mb-0">{{ __("Invite") }}</h2>

                <button
                    type="button"
                    class="icon-btn"
                    @click="inviteModalOpened = false"
                >
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>

            <!-- search input !-->
            <div class="mt-4">
                <label for="search" class="sr-only">{{ __("Search") }}</label>
                <input
                    type="text"
                    class="input"
                    placeholder="Search"
                    name="search"
                    id="search"
                    wire:model="search"
                    wire:input="$dispatch('search-updated')"
                >
            </div>

            <div class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200 mb-4 h-[386px]">
                @foreach($users as $user)
                    <div class="relative flex items-start gap-16 sm:gap-32 md:gap-64 py-4">
                        <div class="min-w-0 flex-1 text-sm leading-6">
                            <label
                                for="user-{{ $user->id }}"
                                class="select-none font-medium text-gray-900"
                            >{{ $user->name }}</label>
                            <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                        </div>
                        <div class="ml-3 flex h-6 items-center">
                            <input
                                id="user-{{ $user->id }}"
                                type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                wire:model="selectedUsers"
                                value="{{ $user->id }}"
                            >
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $users->links() }}
        </div>

        <div class="mt-auto self-start flex gap-4">
            <button
                type="submit"
                class="btn"
                @click="inviteModalOpened = false"
            >
                {{ __("Invite") }}
            </button>

            <button
                type="button"
                class="btn"
                wire:click="add"
            >
                {{ __("Add") }}
            </button>
        </div>
    </form>
</div>
