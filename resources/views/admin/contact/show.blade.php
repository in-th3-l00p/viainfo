@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Contact submissions')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.contact.index'), 'name' => __('Contact submissions')],
            [ 'name' => __('Contact submission')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("All of the contact submissions sent through the contact form") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <p>{{ __("Sent at") }}: {{ $contact->created_at }}</p>
        <p>{{ __("First name") }}: {{ $contact->first_name }}</p>
        <p>{{ __("Last name") }}: {{ $contact->last_name }}</p>
        <p>{{ __("Email") }}: {{ $contact->email }}</p>
        <p>{{ __("Message") }}: {{ $contact->message }}</p>
    </x-layout>
@endsection
