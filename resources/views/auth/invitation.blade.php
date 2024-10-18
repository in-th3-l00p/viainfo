@extends("layouts.main")

@section("content")
    <main class="w-screen h-screen flex justify-center items-center">
        <form
            action="{{ route("invitation.store") }}"
            method="post"
            class="card animate-fadein flex flex-col items-center gap-12"
        >
            @csrf

            <input type="hidden" name="token" value="{{ $invitation->token }}">

            <img
                src="/static/logo.svg" alt="logo"
                class="w-32"
            >

            <div class="flex flex-col gap-6">
                @error("auth")
                    <x-ui.danger-alert>
                        {{ $message }}
                    </x-ui.danger-alert>
                @enderror

                <div>
                    <div class="form-group">
                        <label for="name" class="w-32">{{ __("Name") }}:</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="input"
                            placeholder="{{ __("Name") }}"
                            value="{{ $invitation->name }}"
                        >
                    </div>
                    @error("name")
                    <p class="text-red-600 mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <div class="form-group">
                        <label for="email" class="w-32">{{ __("Email") }}:</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="input"
                            placeholder="{{ __("Email address") }}"
                            value="{{ $invitation->email }}"
                        >
                    </div>
                    @error("email")
                        <p class="text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <div class="form-group">
                        <label for="password" class="w-32">{{ __("Password") }}:</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="input"
                            placeholder="{{ __("Password") }}"
                        >
                    </div>
                    @error("password")
                        <p class="text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <div class="form-group">
                        <label for="password" class="w-32">{{ __("Confirm password") }}:</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="input"
                            placeholder="{{ __("Confirm password") }}"
                        >
                    </div>
                    @error("password_confirmation")
                    <p class="text-red-600 mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-shadow-dark">{{ __("Create") }}</button>
        </form>
    </main>
@endsection
