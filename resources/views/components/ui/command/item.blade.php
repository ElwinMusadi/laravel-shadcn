@props([
    'value',
    'keywords' => '',
    'href' => null,
    'disabled' => false,
])

@php
    $searchValue = \Illuminate\Support\Str::lower(trim($value.' '.$keywords));
    $itemAttributes = $attributes->except('href');
    $itemClasses = 'flex w-full items-center gap-2 rounded-sm px-2 py-1.5 text-left text-sm outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground aria-disabled:pointer-events-none aria-disabled:opacity-50';
@endphp

@if ($href !== null && ! $disabled)
    <a
        href="{{ $href }}"
        data-command-item
        data-command-value="{{ $searchValue }}"
        x-show="matches($el.dataset.commandValue)"
        :tabindex="ready && availableItems[activeIndex] === $el ? 0 : -1"
        :data-active="ready && availableItems[activeIndex] === $el ? 'true' : 'false'"
        @focus="activeIndex = availableItems.indexOf($el)"
        @click="$dispatch('command-close')"
        @keydown.down.prevent="moveActiveItem(1)"
        @keydown.up.prevent="moveActiveItem(-1)"
        @keydown.home.prevent="activeIndex = 0; availableItems[0]?.focus()"
        @keydown.end.prevent="activeIndex = availableItems.length - 1; availableItems.at(-1)?.focus()"
        @keydown.escape="query = ''; $refs.input?.focus(); $dispatch('command-close')"
        {{ $itemAttributes->class($itemClasses) }}
    >
        {{ $slot }}
    </a>
@elseif ($disabled)
    <span
        data-command-item
        data-command-value="{{ $searchValue }}"
        data-disabled
        aria-disabled="true"
        x-show="matches($el.dataset.commandValue)"
        {{ $itemAttributes->class($itemClasses) }}
    >
        {{ $slot }}
    </span>
@else
    <button
        type="button"
        data-command-item
        data-command-value="{{ $searchValue }}"
        x-show="matches($el.dataset.commandValue)"
        :tabindex="ready && availableItems[activeIndex] === $el ? 0 : -1"
        :data-active="ready && availableItems[activeIndex] === $el ? 'true' : 'false'"
        @focus="activeIndex = availableItems.indexOf($el)"
        @click="$dispatch('command-close')"
        @keydown.down.prevent="moveActiveItem(1)"
        @keydown.up.prevent="moveActiveItem(-1)"
        @keydown.home.prevent="activeIndex = 0; availableItems[0]?.focus()"
        @keydown.end.prevent="activeIndex = availableItems.length - 1; availableItems.at(-1)?.focus()"
        @keydown.escape="query = ''; $refs.input?.focus(); $dispatch('command-close')"
        {{ $itemAttributes->class($itemClasses) }}
    >
        {{ $slot }}
    </button>
@endif
