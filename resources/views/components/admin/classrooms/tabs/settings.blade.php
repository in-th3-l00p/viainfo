<section
    x-show="tab === 'settings'"
    class="space-y-8"
>
    <div class="bg-white rounded-md p-8 shadow-md">
        <h2 class="section-title">{{ __("Settings") }}</h2>
        <div class="ml-4 space-y-4">
            <x-admin.classrooms.edit :classroom="$classroom"/>
        </div>
    </div>

    <div @class([
        "bg-white rounded-md p-8 shadow-md",
        "flex gap-8 justify-between items-center"
    ])>
        <div>
            <h2 class="section-title">{{ __("Delete") }}</h2>
            <p>{{ __("Remove this classroom, with all of it's posts, users and events") }}</p>
        </div>

        <div>
            <a
                href="{{ route("admin.classrooms.delete", [ "classroom" => $classroom ]) }}"
                class="btn"
                title="{{ __("Delete") }}"
            >
                {{ __("Delete") }}
            </a>
        </div>
    </div>
</section>
