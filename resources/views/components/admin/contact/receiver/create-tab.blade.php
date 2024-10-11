<div class="mb-8">
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">{{ __("Select a tab") }}</label>
        <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
        <select
            id="tabs"
            name="tabs"
            class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option x-bind:selected="tab === 'user'">{{ __("Platform's user") }}</option>
            <option x-bind:selected="tab === 'custom'">{{ __("Custom") }}</option>
        </select>
    </div>
    <div class="hidden sm:block">
        <nav class="isolate flex divide-x divide-gray-200 rounded-md shadow-md" aria-label="Tabs">
            <button
                type="button"
                class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                x-bind:aria-current="tab === 'user' ? 'page' : null"
                x-bind:class="tab === 'user' ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                @click="tab = 'user'"
            >
                <span>{{ __("Platform's user") }}</span>
                <span
                    aria-hidden="true"
                    class="absolute inset-x-0 bottom-0 h-0.5"
                    x-bind:class="tab === 'user' ? 'bg-indigo-500' : 'bg-transparent'"
                ></span>
            </button>
            <button
                type="button"
                class="group relative min-w-0 flex-1 overflow-hidden rounded-r-md bg-white px-4 py-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                x-bind:aria-current="tab === 'custom' ? 'page' : null"
                x-bind:class="tab === 'custom' ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                @click="tab = 'custom'"
            >
                <span>{{ __("Custom") }}</span>
                <span
                    aria-hidden="true"
                    class="absolute inset-x-0 bottom-0 h-0.5"
                    x-bind:class="tab === 'custom' ? 'bg-indigo-500' : 'bg-transparent'"
                ></span>
            </button>
        </nav>
    </div>
</div>
