@props(['invalid' => false])

@php
    $checkboxAttributes = $invalid ? $attributes->except('aria-invalid') : $attributes;
@endphp

<input
    @if ($invalid) aria-invalid="true" @endif
    {{ $checkboxAttributes->class('size-4 shrink-0 rounded-sm border border-input bg-background accent-primary shadow-xs outline-none transition-[color,box-shadow] focus-visible:ring-2 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 aria-invalid:border-destructive')->merge(['type' => 'checkbox']) }}
>
