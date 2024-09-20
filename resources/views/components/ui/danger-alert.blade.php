<div
    x-data="{ open: true }"
    x-bind:class="!open ? 'alert-close' : ''"
    {{ $attributes->merge([
        "class" => "alert-danger mt-4"
    ]) }}
>
    <div>
        {{ $slot }}
    </div>
    <button
        type="button"
        title="{{ __("Close") }}"
        @click="open = false"
    >
        <i class="fa-solid fa-xmark fa-lg" style="color: #ef4444;"></i>
    </button>
</div>
