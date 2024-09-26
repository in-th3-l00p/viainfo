<div
    x-bind:class="inviteModalOpened ? 'opacity-100' : 'opacity-0 hidden'"
    @class([
        "invite-modal",
        "absolute top-0 left-0 w-screen h-screen z-50",
        "bg-black bg-opacity-50",
        "flex justify-center items-center",
        "transition-all"
    ])
>
    <form
        class="bg-white p-8 rounded-md shadow-md"
        wire:submit.prevent="invite"
    >
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

        <div class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200 mb-4">
            @foreach($users as $user)
                <div class="relative flex items-start gap-16 sm:gap-32 md:gap-64 py-4">
                    <div class="min-w-0 flex-1 text-sm leading-6">
                        <label
                            for="user-{{ $user->id }}"
                            class="select-none font-medium text-gray-900"
                        >{{ $user->name }}</label>
                    </div>
                    <div class="ml-3 flex h-6 items-center">
                        <input
                            id="user-{{ $user->id }}"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                            wire:model="selectedUsers"
                            value="{{ $user->id }}"
                        >
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn">
            Invite
        </button>
    </form>
</div>