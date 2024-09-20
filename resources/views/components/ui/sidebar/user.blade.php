<div
    x-data="{ open: false }"
    class="mt-auto w-full"
>
    <button
        type="button"
        class="sidebar-nav-link w-full"
        @click="open = !open"
    >
        <i class="fa-solid fa-2xl fa-user text-white"></i>
        {{ request()->user()->name }}
    </button>
    <nav x-show="open">
        <x-ui.sidebar.link
            route="account.index"
            icon="fa-pen-to-square"
        >
            {{ __("Profile") }}
        </x-ui.sidebar.link>
        <x-ui.sidebar.link
            route="logout"
            icon="fa-right-from-bracket"
        >
            {{ __("Logout") }}
        </x-ui.sidebar.link>
    </nav>
</div>
