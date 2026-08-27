@props([
    'align' => 'start',
    'label' => 'Popover',
])

@php
    $alignments = [
        'start' => 'left-0',
        'end' => 'right-0',
    ];
@endphp

<div
    x-ref="content"
    x-cloak
    x-show="open"
    :id="`${popoverId}-content`"
    role="dialog"
    aria-modal="false"
    aria-label="{{ $label }}"
    tabindex="-1"
    @keydown.escape.stop.prevent="open = false; $nextTick(() => trigger?.focus())"
    {{ $attributes->class([
        'absolute z-50 mt-2 w-72 max-w-[calc(100vw-2rem)] rounded-md border border-border bg-popover p-4 text-popover-foreground shadow-md outline-none',
        $alignments[$align] ?? $alignments['start'],
    ]) }}
>
    {{ $slot }}
</div>
