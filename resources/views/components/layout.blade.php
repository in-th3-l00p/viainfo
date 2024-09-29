<main class="flex">
    @if (request()->user()->role === 'admin')
        <x-admin.sidebar />
    @else
        <x-user.sidebar />
    @endif

    <section class="layout">
        <header class="mb-16">
            @if ($breadcrumbPath)
                <x-ui.breadcrumbs :path="$breadcrumbPath" />
            @endif
            <h1 class="page-title">{{ $title }}</h1>
            @if (isset($subtitle))
                {{ $subtitle  }}
            @endif
        </header>

        {{ $slot }}
    </section>
</main>
