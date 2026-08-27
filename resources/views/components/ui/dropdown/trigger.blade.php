@props([
    'variant' => 'outline',
    'size' => 'default',
])

<x-ui.button
    :variant="$variant"
    :size="$size"
    x-ref="trigger"
    x-bind:aria-controls="`${dropdownId}-menu`"
    x-bind:aria-expanded="open"
    aria-haspopup="menu"
    @click="trigger = $el; open = !open"
    @keydown.down.prevent="open = true; $nextTick(() => $refs.menu.querySelector('[role=menuitem]:not([aria-disabled='true'])')?.focus())"
    @keydown.up.prevent="open = true; $nextTick(() => [...$refs.menu.querySelectorAll('[role=menuitem]:not([aria-disabled='true'])')].at(-1)?.focus())"
    @keydown.escape.prevent="open = false"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.button>
