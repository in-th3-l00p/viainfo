<section x-show="tab === 'people'">
    @if ($classroom->users()->count() > 0)
        <ul role="list" class="divide-y divide-gray-100 shadow-md rounded-md">
            @foreach ($classroom->users as $user)
                <li @class([
                    "flex justify-between gap-x-6 py-5 bg-white px-4",
                    "rounded-t-md" => $loop->first,
                    "rounded-b-md" => $loop->last,
                ])>
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
                    <div class="flex shrink-0 items-center gap-x-6">
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">{{ __(ucfirst($user->classroomRole)) }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="empty-text">{{ __("No people in this classroom") }}</p>
    @endif
</section>
