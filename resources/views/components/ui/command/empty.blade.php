<div
    x-cloak
    x-show="ready && !availableItems.length"
    role="status"
    {{ $attributes->class('px-2 py-6 text-center text-sm text-muted-foreground') }}
>
    {{ $slot->isEmpty() ? 'No results found.' : $slot }}
</div>
