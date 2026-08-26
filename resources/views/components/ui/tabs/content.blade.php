@props(['value'])

<div
    role="tabpanel"
    tabindex="0"
    x-cloak
    x-show="active === @js($value)"
    :id="`${tabsId}-panel-${@js($value)}`"
    :aria-labelledby="`${tabsId}-tab-${@js($value)}`"
    {{ $attributes->class('mt-3 outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background') }}
>
    {{ $slot }}
</div>
