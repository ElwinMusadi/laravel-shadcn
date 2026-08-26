@props([
    'value',
    'disabled' => false,
])

<button
    type="button"
    role="tab"
    data-value="{{ $value }}"
    :id="`${tabsId}-tab-${@js($value)}`"
    :aria-controls="`${tabsId}-panel-${@js($value)}`"
    :aria-selected="active === @js($value)"
    :tabindex="active === @js($value) ? 0 : -1"
    :data-state="active === @js($value) ? 'active' : 'inactive'"
    @if ($disabled) disabled aria-disabled="true" @endif
    @click="if (! $el.disabled) { active = @js($value); $nextTick(() => $el.focus()) }"
    @focus="if (! $el.disabled) { active = @js($value) }"
    @keydown.right.prevent="const tabs = [...$el.closest('[role=tablist]').querySelectorAll('[role=tab]:not([disabled])')]; tabs[(tabs.indexOf($el) + 1) % tabs.length].focus()"
    @keydown.left.prevent="const tabs = [...$el.closest('[role=tablist]').querySelectorAll('[role=tab]:not([disabled])')]; tabs[(tabs.indexOf($el) - 1 + tabs.length) % tabs.length].focus()"
    @keydown.home.prevent="$el.closest('[role=tablist]').querySelector('[role=tab]:not([disabled])').focus()"
    @keydown.end.prevent="[...$el.closest('[role=tablist]').querySelectorAll('[role=tab]:not([disabled])')].at(-1).focus()"
    {{ $attributes->class('inline-flex h-7 items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium outline-none transition-[color,box-shadow] focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm data-[state=inactive]:hover:text-foreground') }}
>
    {{ $slot }}
</button>
