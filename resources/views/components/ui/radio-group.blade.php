@props([
    'label' => null,
    'description' => null,
    'invalid' => false,
    'disabled' => false,
])

<fieldset
    @if ($invalid) data-invalid @endif
    @if ($disabled) data-disabled @endif
    {{ $attributes->class('flex flex-col gap-3') }}
>
    @if (filled($label))
        <legend class="text-sm font-medium leading-none text-foreground">{{ $label }}</legend>
    @endif

    @if (filled($description))
        <p class="text-sm leading-6 text-muted-foreground">{{ $description }}</p>
    @endif

    <div class="flex flex-col gap-3">
        {{ $slot }}
    </div>
</fieldset>
