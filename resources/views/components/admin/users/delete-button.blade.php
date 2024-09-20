@if (request()->user()->id === $user->id)
    <span class="disabled-icon-btn">
        <i class="fa-solid fa-trash"></i>
    </span>
@else
    <a
        title="{{ __("Delete user") }}"
        href="{{ route("admin.users.delete", [ "user" => $user ]) }}"
        class="icon-btn"
    >
        <i class="fa-solid fa-trash"></i>
    </a>
@endif
