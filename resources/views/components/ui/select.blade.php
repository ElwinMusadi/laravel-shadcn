@props([
    'placeholder' => null,
    'invalid' => false,
])

@php
    $selectAttributes = $invalid ? $attributes->except('aria-invalid') : $attributes;
    $isMultiple = $attributes->has('multiple');
    $hasSelectedOption = preg_match('/\sselected(?:\s|=|>)/', (string) $slot) === 1;
@endphp

<select
    @if ($invalid) aria-invalid="true" @endif
    {{ $selectAttributes->class('flex h-9 w-full min-w-0 rounded-md border border-input bg-background px-3 py-1 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 aria-invalid:border-destructive aria-invalid:ring-destructive/20') }}
>
    @if (filled($placeholder) && ! $isMultiple)
        <option value="" disabled @selected(! $hasSelectedOption)>{{ $placeholder }}</option>
    @endif

    {{ $slot }}
</select>
