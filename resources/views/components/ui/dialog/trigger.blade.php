@props([
    'variant' => 'default',
    'size' => 'default',
])

<x-ui.button
    :variant="$variant"
    :size="$size"
    x-ref="trigger"
    x-bind:aria-controls="`${dialogId}-content`"
    x-bind:aria-expanded="open"
    aria-haspopup="dialog"
    @click="trigger = $el; open = true"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.button>
