<div
    x-cloak
    x-show="open"
    x-transition.opacity
    :id="`${collapsibleId}-content`"
    role="region"
    :aria-labelledby="`${collapsibleId}-trigger`"
    {{ $attributes->class('pt-3') }}
>
    {{ $slot }}
</div>
