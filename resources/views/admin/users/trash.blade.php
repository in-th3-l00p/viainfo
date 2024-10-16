@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Deleted users')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Trash')],
        ]"
    >
        <div @class(["max-w-fit"])>
            <x-slot:subtitle>
                <x-ui.layout.subtitle>
                    {{ __("All the deleted users") }}
                </x-ui.layout.subtitle>
            </x-slot:subtitle>

            <x-admin.users.filter />


            <div class="w-full mb-4 flex items-center gap-2 flex-wrap">
                <form>
                    <button
                        type="submit"
                        title="{{ __("Reset filters") }}"
                        class="icon-btn"
                    >
                        <i class="fa-solid fa-rotate"></i>
                    </button>
                </form>
            </div>
            @if ($users->count() > 0)
                <table class="table mb-4">
                    <thead>
                    <tr>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Email") }}</th>
                        <th>{{ __("Created at") }}</th>
                        <th>{{ __("Deleted at") }}</th>
                        <th>{{ __("Role") }}</th>
                        <th>{{ __("Operations") }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->deleted_at }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="flex gap-2 items-center justify-center">
                                <form
                                    method="POST"
                                    action="{{ route("admin.users.restore", [ "user" => $user ]) }}"
                                >
                                    @csrf
                                    @method("PUT")

                                    <button
                                        type="submit"
                                        title="{{ __("Restore user") }}"
                                        class="icon-btn"
                                    >
                                        <i class="fa-solid fa-trash-can-arrow-up"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            @endif
        </div>

        @if ($users->count() === 0)
            <p class="text-center text-zinc-600 text-lg">
                {{ __("No deleted users found.") }}
            </p>
        @endif
    </x-layout>
@endsection
