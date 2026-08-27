@props([
    'id' => null,
    'open' => false,
])

@php
    $popoverId = $id ?? 'popover-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
    $popoverAttributes = $attributes->except('id');
@endphp

<div id="{{ $popoverId }}" {{ $popoverAttributes->class('relative inline-flex') }}>
    <div x-data="{ open: @js((bool) $open), popoverId: @js($popoverId), trigger: null }" @click.outside="open = false">
        {{ $slot }}
    </div>
</div>
