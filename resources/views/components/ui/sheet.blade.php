@props([
    'id' => null,
    'open' => false,
])

@php
    $sheetId = $id ?? 'sheet-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
    $sheetAttributes = $attributes->except('id');
@endphp

<div id="{{ $sheetId }}" {{ $sheetAttributes->class('relative') }}>
    <div
        x-data="{ open: @js((bool) $open), sheetId: @js($sheetId), trigger: null }"
        x-init="$watch('open', (isOpen) => { if (isOpen) { $nextTick(() => { const focusTarget = $refs.content?.querySelector('[autofocus], a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex=\'-1\'])'); (focusTarget ?? $refs.content)?.focus() }) } else if (trigger) { $nextTick(() => trigger.focus()) } })"
        @command-close="open = false"
    >
        {{ $slot }}
    </div>
</div>
