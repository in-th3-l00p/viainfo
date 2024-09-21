<section class="mb-8">
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">{{ __("Select a tab") }}</label>
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option x-bind:selected="tab === 'feed'">{{ __("Feed") }}</option>
                <option x-bind:selected="tab === 'people'">{{ __("People") }}</option>
                <option x-bind:selected="tab === 'events'">{{ __("Events") }}</option>
                <option x-bind:selected="tab === 'settings'">{{ __("Settings") }}</option>
            </select>
        </div>
        <div class="hidden sm:block">
            <nav class="isolate flex divide-x divide-gray-200 rounded-md shadow-md" aria-label="Tabs">
                <!-- Current: "text-gray-900", Default: "text-gray-500 hover:text-gray-700" -->
                <button
                    type="button"
                    class="group relative min-w-0 flex-1 rounded-l-md overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                    x-bind:aria-current="tab === 'feed' ? 'page' : null"
                    x-bind:class="tab === 'feed' ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                    @click="tab = 'feed'"
                >
                    <span>{{ __("Feed") }}</span>
                    <span
                        aria-hidden="true"
                        class="absolute inset-x-0 bottom-0 h-0.5"
                        x-bind:class="tab === 'feed' ? 'bg-indigo-500' : 'bg-transparent'"
                    ></span>
                </button>
                <button
                    type="button"
                    class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                    x-bind:class="tab === 'people' ? 'rounded-l-md text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                    x-bind:aria-current="tab === 'people' ? 'page' : null"
                    @click="tab = 'people'"
                >
                    <span>{{ __("People") }}</span>
                    <span
                        aria-hidden="true"
                        class="absolute inset-x-0 bottom-0 h-0.5"
                        x-bind:class="tab === 'people' ? 'bg-indigo-500' : 'bg-transparent'"
                    ></span>
                </button>
                <button
                    type="button"
                    class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                    x-bind:aria-current="tab === 'events' ? 'page' : null"
                    x-bind:class="tab === 'events' ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                    @click="tab = 'events'"
                >
                    <span>{{ __("Events") }}</span>
                    <span
                        aria-hidden="true"
                        class="absolute inset-x-0 bottom-0 h-0.5"
                        x-bind:class="tab === 'events' ? 'bg-indigo-500' : 'bg-transparent'"
                    ></span>
                </button>
                <button
                    type="button"
                    class="group relative min-w-0 flex-1 overflow-hidden rounded-r-md bg-white px-4 py-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                    x-bind:aria-current="tab === 'settings' ? 'page' : null"
                    x-bind:class="tab === 'settings' ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                    @click="tab = 'settings'"
                >
                    <span>{{ __("Settings") }}</span>
                    <span
                        aria-hidden="true"
                        class="absolute inset-x-0 bottom-0 h-0.5"
                        x-bind:class="tab === 'settings' ? 'bg-indigo-500' : 'bg-transparent'"
                    ></span>
                </button>
            </nav>
        </div>
    </div>
</section>
