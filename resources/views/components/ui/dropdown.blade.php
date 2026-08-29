@props([
    'id' => null,
    'open' => false,
])

@php
  $dropdownId = $id ?? 'dropdown-' . \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
  $dropdownAttributes = $attributes->except('id');
@endphp

<div id="{{ $dropdownId }}" {{ $dropdownAttributes->class('relative inline-flex') }}>
  <div x-data="{ open: @js((bool) $open), dropdownId: @js($dropdownId), trigger: null }" @click.outside="open = false" class="w-full min-w-0">
    {{ $slot }}
  </div>
</div>
