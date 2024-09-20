<div class="attachment-small">
    <i class="fa-solid fa-file fa-2xl icon"></i>
    <h2 class="title">{{ $attachment->name }}</h2>
    <x-admin.operations.container class="justify-center">
        <x-admin.operations.route
            :title="__('Download')"
            :href="route('admin.test-projects.attachments.show', [
                'test_project' => $attachment->test_project_id,
                'attachment' => $attachment
            ])"
            icon="fa-download"
        />

        <x-admin.operations.route
            :title="__('Edit')"
            :href="route('admin.test-projects.attachments.edit', [
                'test_project' => $attachment->test_project_id,
                'attachment' => $attachment
            ])"
            icon="fa-pen-to-square"
        />

        <x-admin.operations.route
            :title="__('Delete')"
            :href="route('admin.test-projects.attachments.delete', [
                'test_project' => $attachment->test_project_id,
                'attachment' => $attachment
            ])"
            icon="fa-trash"
        />
    </x-admin.operations.container>
</div>
