@props(['heading' => null])

<section
    x-show="query === '' || Array.from($el.querySelectorAll('[data-command-item]:not([data-disabled])')).some((item) => matches(item.dataset.commandValue))"
    {{ $attributes->class('flex flex-col gap-1 py-1') }}
>
    @if ($heading)
        <h3 class="px-2 py-1 text-xs font-medium text-muted-foreground">{{ $heading }}</h3>
    @endif

    {{ $slot }}
</section>
