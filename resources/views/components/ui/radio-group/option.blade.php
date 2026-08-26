@props([
    'name',
    'value',
    'id' => null,
    'checked' => false,
    'disabled' => false,
    'description' => null,
    'invalid' => false,
])

@php
    $optionId = $id ?? str($name.'-'.$value)->slug();
    $inputAttributes = $invalid ? $attributes->except('aria-invalid') : $attributes;
@endphp

<div class="flex items-start gap-3">
    <input
        id="{{ $optionId }}"
        name="{{ $name }}"
        type="radio"
        value="{{ $value }}"
        @checked($checked)
        @disabled($disabled)
        @if ($invalid) aria-invalid="true" @endif
        {{ $inputAttributes->class('mt-0.5 size-4 shrink-0 border-input bg-background accent-primary shadow-xs outline-none transition-[color,box-shadow] focus-visible:ring-2 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 aria-invalid:border-destructive') }}
    >

    <div class="flex min-w-0 flex-col gap-1">
        <x-ui.label :for="$optionId" :disabled="$disabled" class="cursor-pointer">{{ $slot }}</x-ui.label>

        @if (filled($description))
            <p class="text-sm leading-6 text-muted-foreground">{{ $description }}</p>
        @endif
    </div>
</div>
