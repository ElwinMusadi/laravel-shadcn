@props([
    'href' => null,
    'active' => false,
    'disabled' => false,
])

@php
    $classes = [
        'inline-flex size-9 items-center justify-center rounded-md text-sm font-medium transition-colors outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background',
        'bg-primary text-primary-foreground hover:bg-primary/90' => $active,
        'hover:bg-accent hover:text-accent-foreground' => ! $active && ! $disabled,
        'pointer-events-none opacity-50' => $disabled,
    ];
@endphp

@if ($disabled)
    <span role="link" aria-disabled="true" tabindex="-1" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </span>
@else
    <a
        @if ($active) aria-current="page" @endif
        {{ $attributes->class($classes)->merge(['href' => $href]) }}
    >
        {{ $slot }}
    </a>
@endif
