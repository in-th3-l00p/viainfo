<?php

namespace App\View\Components\Ui\Attachments;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Attachment extends Component
{
    public function __construct(
        public string $baseRoute,
        public $entityName,
        public $entity,
        public $attachment,
        public ?bool $admin = false
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.attachments.attachment');
    }
}
