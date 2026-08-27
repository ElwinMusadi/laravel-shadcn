@props(['align' => 'end'])

@php
    $alignments = [
        'start' => 'left-0',
        'end' => 'right-0',
    ];
@endphp

<div
    x-ref="menu"
    x-cloak
    x-show="open"
    :id="`${dropdownId}-menu`"
    role="menu"
    aria-orientation="vertical"
    tabindex="-1"
    @keydown.escape.stop.prevent="open = false; $nextTick(() => trigger?.focus())"
    {{ $attributes->class([
        'absolute z-50 mt-2 min-w-48 max-w-[calc(100vw-2rem)] rounded-md border border-border bg-popover p-1 text-popover-foreground shadow-md outline-none',
        $alignments[$align] ?? $alignments['end'],
    ]) }}
>
    {{ $slot }}
</div>
