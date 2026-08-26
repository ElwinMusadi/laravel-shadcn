@props([
    'required' => false,
    'disabled' => false,
])

<label
    @if ($disabled) aria-disabled="true" @endif
    {{ $attributes->class([
        'text-sm font-medium leading-none text-foreground',
        'cursor-not-allowed opacity-50' => $disabled,
    ]) }}
>
    {{ $slot }}

    @if ($required)
        <span aria-hidden="true" class="text-destructive">*</span><span class="sr-only"> required</span>
    @endif
</label>
