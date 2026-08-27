@props([
    'id' => null,
    'defaultOpen' => false,
])

@php
    $collapsibleId = $id ?? 'collapsible-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
    $collapsibleAttributes = $attributes->except('id');
@endphp

<div id="{{ $collapsibleId }}" {{ $collapsibleAttributes->class('w-full') }}>
    <div x-data="{ open: @js((bool) $defaultOpen), collapsibleId: @js($collapsibleId) }">
        {{ $slot }}
    </div>
</div>
