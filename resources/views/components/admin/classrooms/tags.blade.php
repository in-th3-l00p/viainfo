<div class="flex items-center">
    <h3 class="w-28">{{ __("Tags") }}:</h3>
    <div x-data="selection">
        <div class="flex flex-wrap gap-2">
            @foreach ($classroom->tags()->get() as $tag)
                <button
                    type="button"
                    class="tag"
                    @click="toggle({{ $tag->id }})"
                    x-bind:class="check({{ $tag->id }}) ? 'tag-toggled' : ''"
                >
                    {{ $tag->name }}
                </button>
            @endforeach
            <a
                href="{{ route("admin.classrooms.tags.create", [
                                "classroom" => $classroom
                            ]) }}"
                class="tag !px-8"
            >
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        <div
            x-show="!empty()"
            class="flex items-center gap-4"
        >
            <p>
                <span x-text="selected.length"></span>
                items selected
            </p>

            <form
                method="post"
                action="{{ route("admin.classrooms.tags.destroyBatch", [
                            "classroom" => $classroom
                        ]) }}"
            >
                @csrf
                @method("DELETE")

                <template x-for="id in selected">
                    <input
                        type="hidden" aria-hidden="true"
                        id="tag" name="tags[]"
                        x-bind:value="id"
                    >
                </template>

                <button type="submit" class="icon-btn">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- used for tag selection functionality !-->
    <script defer>
        document.addEventListener("alpine:init", () => {
            Alpine.data("selection", () => ({
                selected: [],
                toggle(id) {
                    const index = this.selected.indexOf(id);
                    if (index !== -1) {
                        this.selected.splice(index, 1);
                    } else {
                        this.selected.push(id);
                    }
                },
                check(id) {
                    return this.selected.indexOf(id) !== -1;
                },
                empty() {
                    return this.selected.length === 0;
                }
            }))
        })
    </script>
</div>
