@if ($errors->count() > 0)
    <x-ui.danger-alert class="text-red-600 mb-8">
        <p>{{ $text }}:</p>
        <ul class="list-disc ms-8">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-ui.danger-alert>
@endif
