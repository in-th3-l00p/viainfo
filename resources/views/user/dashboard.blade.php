@php
    use App\Models\TestProjects\TestProject;
    use App\Models\User;
@endphp
@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Hello') . ', ' . request()->user()->name . '!'"
        :breadcrumbPath="[
            [ 'name' => __('Dashboard') ],
        ]"
    >
        <h2 class="section-title">{{ __("Quick access") }}</h2>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <x-ui.dashboard.quick-access
                :title="__('Profile')"
                :description="__('Access your profile')"
                :href="route('account.index')"
                icon="fa-user"
            />

            <x-ui.dashboard.quick-access
                :title="__('Classrooms')"
                :description="__('Access your classrooms')"
                :href="route('classrooms.index')"
                icon="fa-chalkboard"
            />
        </div>
    </x-layout>
@endsection
