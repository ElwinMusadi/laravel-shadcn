@props([
    'variant' => 'outline',
    'size' => 'default',
])

<x-ui.button
    :variant="$variant"
    :size="$size"
    x-ref="trigger"
    x-bind:aria-controls="`${popoverId}-content`"
    x-bind:aria-expanded="open"
    aria-haspopup="dialog"
    @click="trigger = $el; open = !open"
    @keydown.down.prevent="trigger = $el; open = true; $nextTick(() => $refs.content.querySelector('[autofocus], a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex='-1'])')?.focus())"
    @keydown.escape.prevent="open = false"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.button>
