<?php

namespace App\View\Components\Ui\Attachments;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AttachmentList extends Component
{
    public function __construct(
        public string $baseRoute,
        public string $entityName,
        public $entity,
        public $attachments,
        public ?bool $admin = false,
        public ?bool $includeTitle = false,
        public ?bool $includeIndex = false
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.attachments.attachment-list');
    }
}
