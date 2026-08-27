@props([
    'variant' => 'ghost',
    'size' => 'default',
])

<x-ui.button
    :variant="$variant"
    :size="$size"
    x-bind:id="`${collapsibleId}-trigger`"
    x-bind:aria-expanded="open"
    x-bind:aria-controls="`${collapsibleId}-content`"
    @click="open = !open"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.button>
