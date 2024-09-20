@push("vite")
    @vite([ "resources/scss/components/attachment.scss" ])
@endpush

<section>
    @if ($includeTitle)
        <h2 class="section-title">{{ __("Attachments") }}</h2>
    @endif

    @if ($admin)
        <x-admin.operations.container class="mb-4">
            <x-admin.operations.route
                :title="__('Add')"
                :href="route($baseRoute . '.attachments.create', [
                    $entityName => $entity
                ])"
                icon="fa-plus"
            />

            @if ($includeIndex)
                <x-admin.operations.route
                    :title="__('Show only attachments')"
                    :href="route($baseRoute . '.attachments.index', [
                        $entityName => $entity
                    ])"
                    icon="fa-eye"
                />
            @endif

            <x-admin.operations.route
                :title="__('Trash')"
                :href="route($baseRoute . '.attachments.trash', [
                    $entityName => $entity
                ])"
                icon="fa-trash"
            />
        </x-admin.operations.container>
    @endif

    <div class="flex flex-wrap gap-8">
        @forelse ($attachments as $attachment)
            <x-ui.attachments.attachment
                :baseRoute="$baseRoute"
                :entityName="$entityName"
                :entity="$entity"
                :attachment="$attachment"
                :admin="$admin"
            />
        @empty
            <p class="empty-text mx-auto">{{ __("There are no attachments") }}</p>
        @endforelse
    </div>
</section>
