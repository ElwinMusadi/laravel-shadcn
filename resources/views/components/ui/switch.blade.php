@props([
    'checked' => false,
    'disabled' => false,
    'invalid' => false,
])

@php
    $switchAttributes = $invalid ? $attributes->except('aria-invalid') : $attributes;
@endphp

<span class="relative inline-flex h-5 w-9 shrink-0">
    <input
        type="checkbox"
        role="switch"
        @checked($checked)
        @disabled($disabled)
        @if ($invalid) aria-invalid="true" @endif
        {{ $switchAttributes->class('peer absolute inset-0 size-full cursor-pointer appearance-none rounded-full opacity-0 outline-none disabled:cursor-not-allowed')->merge(['value' => '1']) }}
    >
    <span aria-hidden="true" class="pointer-events-none block h-5 w-9 rounded-full bg-input transition-colors peer-checked:bg-primary peer-checked:[&>span]:translate-x-4 peer-focus-visible:ring-2 peer-focus-visible:ring-ring/50 peer-disabled:opacity-50 peer-aria-invalid:bg-destructive">
        <span class="block size-4 translate-x-0.5 translate-y-0.5 rounded-full bg-background shadow-sm transition-transform"></span>
    </span>
</span>
