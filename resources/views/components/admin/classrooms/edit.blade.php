<form
    action="{{ route("admin.classrooms.update", [ "classroom" => $classroom ]) }}"
    method="post"
    class="max-w-xl"
>
    @csrf
    @method("PUT")

    @if ($errors->count() > 0)
        <div class="text-red-600 mb-8">
            <p>__('The following errors occurred when trying to create this classroom')</p>
            <ul class="list-disc ms-8">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group mb-4">
        <label for="name" class="label w-32">{{ __("Name") }}:</label>
        <input
            type="text" name="name" id="name"
            @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
            placeholder="{{ __("Classroom's name") }}"
            value="{{ $classroom->name }}"
        >
    </div>

    <div class="form-group mb-4">
        <label for="slug" class="label w-32">{{ __("Slug") }}:</label>
        <div class="relative w-full">
            <input
                type="text" name="slug" id="slug"
                @class(["input", "ring-2 ring-rose-600" => $errors->has("slug")])
                placeholder="{{ __("Classroom's slug") }}"
                value="{{ $classroom->slug }}"
            >

            <button
                type="button"
                title="{{ __("Auto generate") }}"
                onclick="generateSlug()"
                class="icon-btn absolute top-1/2 -translate-y-1/2 right-0 p-2 me-2"
            >
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="form-group mb-8">
        <label for="description" class="label w-32">{{ __("Description") }}:</label>
        <textarea
            name="description" id="description" class="input"
            placeholder="{{ __("Classroom's description") }}"
        >{!! $classroom->description !!}</textarea>
    </div>

    <button
        type="submit"
        class="btn"
        title="{{ __("Update") }}"
    >
        {{ __("Update") }}
    </button>
</form>
