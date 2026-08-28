@props([
    'href' => null,
    'disabled' => false,
    'type' => 'button',
])

@php
    $itemAttributes = $attributes->except(['href', 'type']);
    $itemClasses = 'flex w-full cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-left text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground aria-disabled:pointer-events-none aria-disabled:opacity-50';
@endphp

@if ($href !== null && ! $disabled)
    <a
        href="{{ $href }}"
        role="menuitem"
        tabindex="-1"
        @click="open = false"
        @keydown.down.prevent="const items = Array.from($el.closest('[role=menu]').querySelectorAll('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')); items[(items.indexOf($el) + 1) % items.length]?.focus()"
        @keydown.up.prevent="const items = Array.from($el.closest('[role=menu]').querySelectorAll('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')); items[(items.indexOf($el) - 1 + items.length) % items.length]?.focus()"
        @keydown.home.prevent="$el.closest('[role=menu]').querySelector('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')?.focus()"
        @keydown.end.prevent="Array.from($el.closest('[role=menu]').querySelectorAll('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')).at(-1)?.focus()"
        {{ $itemAttributes->class($itemClasses) }}
    >
        {{ $slot }}
    </a>
@elseif ($disabled)
    <span role="menuitem" aria-disabled="true" {{ $itemAttributes->class($itemClasses) }}>
        {{ $slot }}
    </span>
@else
    <button
        type="{{ $type }}"
        role="menuitem"
        tabindex="-1"
        @click="open = false"
        @keydown.down.prevent="const items = Array.from($el.closest('[role=menu]').querySelectorAll('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')); items[(items.indexOf($el) + 1) % items.length]?.focus()"
        @keydown.up.prevent="const items = Array.from($el.closest('[role=menu]').querySelectorAll('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')); items[(items.indexOf($el) - 1 + items.length) % items.length]?.focus()"
        @keydown.home.prevent="$el.closest('[role=menu]').querySelector('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')?.focus()"
        @keydown.end.prevent="Array.from($el.closest('[role=menu]').querySelectorAll('[role=menuitem]:not([aria-disabled=&quot;true&quot;])')).at(-1)?.focus()"
        {{ $itemAttributes->class($itemClasses) }}
    >
        {{ $slot }}
    </button>
@endif
