@props([
    'id' => null,
    'open' => false,
])

@php
    $dialogId = $id ?? 'dialog-'.\Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(8));
    $dialogAttributes = $attributes->except('id');
@endphp

<div id="{{ $dialogId }}" {{ $dialogAttributes->class('relative') }}>
    <div
        x-data="{
            open: @js((bool) $open),
            dialogId: @js($dialogId),
            trigger: null,
            close() {
                if (!this.open) {
                    return;
                }

                this.open = false;
                this.$dispatch('dialog-closed', { id: this.dialogId });
            },
            openFromEvent(event) {
                if (event.detail?.id !== this.dialogId) {
                    return;
                }

                this.trigger = event.detail.trigger ?? document.activeElement;
                this.open = true;
            },
        }"
        x-init="$watch('open', (isOpen) => { if (isOpen) { $nextTick(() => { const focusTarget = $refs.content?.querySelector('[autofocus], a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex=\'-1\'])'); (focusTarget ?? $refs.content)?.focus() }) } else if (trigger) { $nextTick(() => trigger.focus()) } })"
        @command-close="close()"
        @dialog-open.window="openFromEvent($event)"
    >
        {{ $slot }}
    </div>
</div>
