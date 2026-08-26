@props([
    'id' => null,
    'default' => null,
])

@php
    $tabsId = $id ?? 'tabs-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
    $tabsAttributes = $attributes->except('id');
@endphp

<div
    id="{{ $tabsId }}"
    x-data="{ tabsId: @js($tabsId), active: @js($default) }"
    x-init="if (! active) { active = $refs.list.querySelector('[role=tab]:not([disabled])')?.dataset.value }"
    {{ $tabsAttributes->class('w-full') }}
>
    {{ $slot }}
</div>
