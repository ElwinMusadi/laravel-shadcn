@props([
    'orientation' => 'vertical',
    'invalid' => false,
    'disabled' => false,
])

@php
    $isHorizontal = $orientation === 'horizontal';
    $fieldAttributes = $attributes->except(['data-invalid', 'data-disabled']);
    $isInvalid = $invalid || $attributes->has('data-invalid');
    $isDisabled = $disabled || $attributes->has('data-disabled');
@endphp

<div
    @if ($isInvalid) data-invalid @endif
    @if ($isDisabled) data-disabled @endif
    {{ $fieldAttributes->class($isHorizontal ? 'flex items-start gap-3' : 'flex flex-col gap-2') }}
>
    {{ $slot }}
</div>
