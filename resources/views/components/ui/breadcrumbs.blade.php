<nav class="flex gap-2 items-center text-gray-400 mb-2 text-lg">
    @for ($i = 0; $i < sizeof($path); $i++)
        @if (isset($path[$i]["href"]))
            <a
                href="{{ $path[$i]["href"] }}"
                @class([
                    "hover:text-gray-700 transition-all",
                    "text-gray-600" => $i === sizeof($path) - 1
                ])
            >
                {{ $path[$i]["name"] }}
            </a>
        @else
            <span
                @class([
                    "text-gray-700" => $i === sizeof($path) - 1
                ])
            >
                {{ $path[$i]["name"] }}
            </span>
        @endif

        @if ($i < sizeof($path) - 1)
            <span class="text-lg">{{'>' }}</span>
        @endif
    @endfor
</nav>
