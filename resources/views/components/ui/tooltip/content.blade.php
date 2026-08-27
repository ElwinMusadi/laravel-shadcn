<span :id="`${tooltipId}-description`" class="sr-only">{{ $slot }}</span>

<span
    x-cloak
    x-show="open"
    x-transition.opacity
    role="tooltip"
    aria-hidden="true"
    class="absolute bottom-full left-1/2 z-50 mb-2 w-max max-w-64 -translate-x-1/2 rounded-md bg-foreground px-2 py-1 text-xs text-background shadow-sm"
>
    {{ $slot }}
</span>
