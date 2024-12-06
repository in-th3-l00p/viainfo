<x-ui.sidebar>
    <x-ui.sidebar.branding />

    <x-ui.sidebar.link
        route="admin.dashboard"
        icon="fa-chart-line"
    >
        {{ __("Dashboard") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.link
        route="admin.users.index"
        icon="fa-user"
    >
        {{ __("Users") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.link
        route="admin.classrooms.index"
        icon="fa-chalkboard"
    >
        {{ __("Classrooms") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.link
        route="admin.contact.index"
        icon="fa-message"
    >
        {{ __("Contact") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.link
        route="admin.docs.index"
        icon="fa-book"
    >
        {{ __("Docs") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.user />
</x-ui.sidebar>
