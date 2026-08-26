@props([
    'orientation' => 'horizontal',
    'decorative' => true,
])

@php
    $isVertical = $orientation === 'vertical';
@endphp

<div
    @if ($decorative)
        aria-hidden="true"
    @else
        role="separator"
        aria-orientation="{{ $isVertical ? 'vertical' : 'horizontal' }}"
    @endif
    {{ $attributes->class($isVertical ? 'h-full w-px shrink-0 bg-border' : 'h-px w-full bg-border') }}
></div>
