@extends("layouts.main")

@section("content")
    <main class="w-screen h-screen flex justify-center items-center">
        <form
            action="{{ route("login.submit") }}"
            method="post"
            class="card animate-fadein flex flex-col items-center gap-12"
        >
            @csrf

            <div class="self-start">
                <a
                    href="{{ route("index") }}"
                    class="text-sm font-semibold leading-7 text-blue-600"
                >
                    <i class="fa-solid fa-arrow-left me-2"></i>
                    {{ __("Back to home page") }}
                </a>
            </div>

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
                        <label for="email" class="w-32">{{ __("Email") }}:</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="input"
                            placeholder="{{ __("Email address") }}"
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
            </div>

            <button type="submit" class="btn btn-lg btn-shadow-dark">{{ __("Login") }}</button>
        </form>
    </main>
@endsection
