<section x-show="tab === 'events'">
    <x-admin.operations.container class="mb-8">
        <a
            href="{{ route(
                "admin.classrooms.events.create",
                [ "classroom" => $classroom ]
            ) }}"
            class="icon-btn"
            title={{ __("Add") }}
        >
            <i class="fas fa-plus"></i>
        </a>
    </x-admin.operations.container>

</section>
