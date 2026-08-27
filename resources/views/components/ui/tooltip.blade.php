@props(['id' => null])

@php
    $tooltipId = $id ?? 'tooltip-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
    $tooltipAttributes = $attributes->except('id');
@endphp

<span id="{{ $tooltipId }}" {{ $tooltipAttributes->class('relative inline-flex') }}>
    <span x-data="{ open: false, tooltipId: @js($tooltipId) }">
        {{ $slot }}
    </span>
</span>
