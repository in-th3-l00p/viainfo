<x-ui.sidebar>
    <x-ui.sidebar.branding />

    <x-ui.sidebar.link
        route="user.dashboard"
        icon="fa-chart-line"
    >
        {{ __("Dashboard") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.link
        route="classrooms.index"
        icon="fa-chalkboard"
    >
        {{ __("Classrooms") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.user />
</x-ui.sidebar>
