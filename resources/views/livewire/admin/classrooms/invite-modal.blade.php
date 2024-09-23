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
    <div class="bg-white p-8 rounded-md shadow-md">
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
    </div>
</div>
