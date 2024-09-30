<section
    x-show="tab === 'settings'"
    class="space-y-8"
>
    <div @class([
        "bg-white rounded-md p-8 shadow-md",
        "flex gap-8 justify-between items-center"
    ])>
        <div>
            <h2 class="section-title">{{ __("Leave") }}</h2>
            <p>{{ __("Leave this classroom, with no possibility to join back by yourself") }}</p>
        </div>

        <div>
            <a
                href="{{ route("classrooms.leave.form", [ "classroom" => $classroom ]) }}"
                class="btn"
                title="{{ __("Leave") }}"
            >
                {{ __("Leave") }}
            </a>
        </div>
    </div>
</section>
