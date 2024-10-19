@php
    use App\Models\Classroom\Classroom;use App\Models\Classroom\ClassroomEvent;use App\Models\User;
@endphp
@extends("layouts.main")

@section("content")
    <x-layout
            :title="__('Hello') . ', ' . request()->user()->name . '!'"
            :breadcrumbPath="[
            [ 'name' => __('Dashboard') ],
        ]"
    >
        <div class="bg-white rounded-md shadow-md mb-16">
            <div class="mx-auto max-w-7xl">
                <div class="grid grid-cols-1 gap-px bg-white lg:grid-cols-3">
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">{{ __("Number of users") }}</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ User::query()->count() }}
                            </span>
                            <span class="text-sm text-gray-500">{{ __("users") }}</span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">{{ __("Number of classrooms") }}</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ Classroom::query()->count() }}
                            </span>
                            <span class="text-sm text-gray-500">{{ __("classrooms") }}</span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">{{ __("Number of events") }}</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ ClassroomEvent::query()->count() }}
                            </span>
                            <span class="text-sm text-gray-500">{{ __("events") }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title">{{ __("Quick access") }}</h2>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <x-ui.dashboard.quick-access
                    :title="__('Users')"
                    :description="__('Access the platform\'s users')"
                    :href="route('admin.users.index')"
                    icon="fa-table"
            />

            <x-ui.dashboard.quick-access
                    :title="__('Classrooms')"
                    :description="__('Access the platform\'s classrooms')"
                    :href="route('admin.classrooms.index')"
                    icon="fa-chalkboard"
            />

            <x-ui.dashboard.quick-access
                    :title="__('Profile')"
                    :description="__('Access your profile')"
                    :href="route('account.index')"
                    icon="fa-user"
            />

            <x-ui.dashboard.quick-access
                    :title="__('Contact')"
                    :description="__('Access the platform\'s contact submissions')"
                    :href="route('admin.contact.index')"
                    icon="fa-message"
            />
        </div>
    </x-layout>
@endsection
