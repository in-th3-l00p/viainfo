@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Add contact notification receiver')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.contact.index'), 'name' => __('Contact submissions') ],
            [ 'name' => __('Add notification receiver') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Add a new notification receiver for contact submissions") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <!-- typeTab system !-->
        <section
            class="mb-8"
            x-data="{ typeTab: $persist('user') }"
        >
            <x-admin.contact.receiver.create-tab />

            <!-- user platform thang !-->
            <form
                x-show="typeTab === 'user'"
                action="{{ route("admin.contact.receivers.store") }}"
                method="post"
                class="max-w-xl"
            >
                @csrf

                <input type="hidden" name="type" value="user">

                @error("user_id")
                    <p class="text-red-600 mb-4">{{ $message }}</p>
                @enderror

                @foreach ($users as $user)
                    <div>
                        <input type="radio" id="user_id" name="user_id" value="{{ $user->id }}">
                        <label for="user_id">{{ $user->name }}</label>
                    </div>
                @endforeach

                <div class="my-4">
                    {{ $users->links() }}
                </div>

                <button
                    type="submit"
                    class="btn"
                    title="{{ __("Add") }}"
                >
                    {{ __("Add") }}
                </button>
            </form>

            <!-- custom type thang !-->
            <form
                x-show="typeTab === 'custom'"
                action="{{ route("admin.contact.receivers.store") }}"
                method="post"
                class="max-w-xl"
            >
                @csrf

                <x-admin.errors-alert
                    :text="__('The following errors occurred when trying to add this notification receiver')"
                    :errors="$errors"
                />

                <div class="form-group mb-4">
                    <label for="name" class="label w-32">{{ __("Name") }}:</label>
                    <input
                        type="text" name="name" id="name"
                        @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                        placeholder="{{ __("Receiver's name") }}"
                        value="{{ old("name") }}"
                    >
                    @error("name")
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="email" class="label w-32">{{ __("Email") }}:</label>
                    <input
                        type="email" name="email" id="email"
                        @class(["input", "ring-2 ring-rose-600" => $errors->has("email")])
                        placeholder="{{ __("Receiver's email") }}"
                        value="{{ old("email") }}"
                    >
                    @error("email")
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="btn"
                    title="{{ __("Add") }}"
                >
                    {{ __("Add") }}
                </button>
            </form>
        </section>
    </x-layout>
@endsection
