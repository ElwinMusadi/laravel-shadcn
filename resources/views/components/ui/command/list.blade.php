@props(['label' => 'Command results'])

<div
    x-ref="list"
    :id="`${commandId}-list`"
    role="list"
    aria-label="{{ $label }}"
    {{ $attributes->class('flex max-h-72 flex-col gap-1 overflow-y-auto p-2') }}
>
    {{ $slot }}
</div>
