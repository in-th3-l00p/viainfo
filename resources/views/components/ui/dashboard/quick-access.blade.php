<div class="relative flex items-center space-x-6 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:border-gray-400">
    <div class="flex-shrink-0">
        <i @class(["fa-solid  text-blue-600 text-6xl", $icon])></i>
    </div>
    <div class="min-w-0 flex-1">
        <a href="{{ $href }}" class="focus:outline-none">
            <span class="absolute inset-0" aria-hidden="true"></span>
            <p class="text-lg font-medium text-gray-900">{{ $title }}</p>
            <p class="truncate text-sm text-gray-500">{{ $description }}</p>
        </a>
    </div>
</div>
