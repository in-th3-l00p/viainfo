<a
    href="{{ route($route) }}"
    @class([
        "sidebar-nav-link",
        "sidebar-nav-link-active" => Route::is($route)
    ])
>
    <i @class(["fa-solid fa-2xl text-white", $icon])></i>
    <div>{{ $slot }}</div>
</a>
