<form class="mb-16" id="search-form">
    <div class="flex flex-wrap gap-16">
        <div>
            <h2 class="text-2xl mb-2">{{ __("Search") }}:</h2>

            <div class="form-group mb-2">
                <label for="search_name" class="label w-16">{{ __("Name") }}:</label>
                <input
                    type="text" name="search_name" id="search_name" class="input"
                    placeholder="{{ __("Search by name") }}"
                    value="{{ request()->search_name }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="search_email" class="label w-16">{{ __("Email") }}:</label>
                <input
                    type="text" name="search_email" id="search_email" class="input"
                    placeholder="{{ __("Search by email") }}"
                    value="{{ request()->search_email }}"
                >
            </div>

            <button
                type="submit"
                class="btn mt-auto"
                title="{{ __("Apply filters") }}"
            >
                {{ __("Apply") }}
            </button>
        </div>

        <div>
            <h2 class="text-2xl mb-2">{{ __("Select") }}:</h2>

            <label for="roles">Roles:</label>
            <div class="flex gap-6">
                <div class="form-group">
                    <input
                        type="checkbox"
                        name="roles[]"
                        id="users"
                        value="user"
                        class="checkbox"
                        @checked(
                            request()->roles === null ||
                            in_array("users", request()->roles)
                        )
                    >
                    <label for="users">Users</label>
                </div>

                <div class="form-group">
                    <input
                        type="checkbox"
                        name="roles[]"
                        id="admins"
                        value="admin"
                        class="checkbox"
                        @checked(
                            request()->roles === null ||
                            in_array("admin", request()->roles)
                        )
                    >
                    <label for="admins">Admins</label>
                </div>
            </div>
        </div>
    </div>
</form>
