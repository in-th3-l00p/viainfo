<div class="attachment">
    <i class="fa-solid fa-file fa-2xl icon"></i>
    <h2 class="title">{{ $attachment->name }}</h2>
    @if ($admin)
        <x-admin.operations.container class="justify-center">
            <x-admin.operations.route
                :title="__('Download')"
                :href="route($baseRoute . '.attachments.show', [
                    $entityName => $entity,
                    'attachment' => $attachment
                ])"
                icon="fa-download"
            />

            <x-admin.operations.route
                :title="__('Edit')"
                :href="route($baseRoute . '.attachments.edit', [
                    $entityName => $entity,
                    'attachment' => $attachment
                ])"
                icon="fa-pen-to-square"
            />

            <x-admin.operations.route
                :title="__('Delete')"
                :href="route($baseRoute . '.attachments.delete', [
                    $entityName => $entity,
                    'attachment' => $attachment
                ])"
                icon="fa-trash"
            />
        </x-admin.operations.container>
    @else
        <div class="btn-group justify-center">
            <a
                title="{{ __('Download') }}"
                href="{{ route($baseRoute . '.attachments.show', [
                    $entityName => $entity,
                    'attachment' => $attachment
                ]) }}"
                class="icon-btn"
            >
                <i class="fa-solid fa-download"></i>
            </a>
        </div>
    @endif
</div>
