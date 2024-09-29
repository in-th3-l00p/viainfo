<?php $count = $classroom->invitedUsers()->count(); ?>
<div @class(["mb-8" => $count])>
    @if ($count > 0)
        <h2>{{ __("Invited people") }}</h2>
        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($classroom->invitedUsers as $user)
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                             src="/static/pfp.png"
                             alt="pfp">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900">
                                {{ $user->name }}
                            </p>
                            <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>

                    <form
                        action="{{ route("admin.classrooms.invitations.destroy", [
                                "classroom" => $classroom,
                                "user" => $user
                            ]) }}"
                        method="post"
                    >
                        @csrf
                        @method("DELETE")

                        <button
                            type="submit"
                            title="{{ __("Remove") }}"
                            class="icon-btn !bg-red-600 text-white"
                        >
                            <span class="sr-only">{{ __("Remove user invitation of ") . $user->name }}</span>
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>
