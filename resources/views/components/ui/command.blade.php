@props(['id' => null])

@php
    $commandId = $id ?? 'command-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
    $commandAttributes = $attributes->except('id');
@endphp

<div id="{{ $commandId }}" {{ $commandAttributes->class('w-full overflow-hidden rounded-lg border border-border bg-popover text-popover-foreground shadow-sm') }}>
    <div
        x-data="{
            query: '',
            activeIndex: 0,
            ready: false,
            commandId: @js($commandId),
            matches(value) { return value.toLowerCase().includes(this.query.trim().toLowerCase()) },
            get availableItems() { const list = this.$refs.list; return list ? Array.from(list.querySelectorAll('[data-command-item]:not([data-disabled])')).filter((item) => this.matches(item.dataset.commandValue)) : [] },
            moveActiveItem(direction) { const items = this.availableItems; if (!items.length) { return } this.activeIndex = (this.activeIndex + direction + items.length) % items.length; items[this.activeIndex]?.focus() },
            selectActiveItem() { this.availableItems[this.activeIndex]?.click() }
        }"
        x-init="$watch('query', () => { activeIndex = 0 }); $nextTick(() => { ready = true })"
    >
        {{ $slot }}
    </div>
</div>
