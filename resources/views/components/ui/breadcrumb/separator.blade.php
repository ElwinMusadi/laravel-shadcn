<li role="presentation" aria-hidden="true" {{ $attributes->class('flex size-3.5 items-center justify-center') }}>
    {{ $slot->isEmpty() ? '/' : $slot }}
</li>
