<div {{ $attributes->merge([
    "class" => "btn-group"
]) }}>
    @if ($text)
        <h2 class="text-lg me-2">Operations:</h2>
    @endif
    {{ $slot }}
</div>
