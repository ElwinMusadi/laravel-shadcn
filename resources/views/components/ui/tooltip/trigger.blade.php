@props([
    'variant' => 'ghost',
    'size' => 'icon',
    'disabled' => false,
])

<span
    x-ref="trigger"
    class="inline-flex"
    @mouseenter="open = true"
    @mouseleave="open = false"
    @focusin="open = true"
    @focusout="open = false"
>
    <x-ui.button
        :variant="$variant"
        :size="$size"
        :disabled="$disabled"
        x-bind:aria-describedby="`${tooltipId}-description`"
        {{ $attributes }}
    >
        {{ $slot }}
    </x-ui.button>
</span>
