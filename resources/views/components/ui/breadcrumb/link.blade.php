@props(['href' => null])

<a {{ $attributes->class('transition-colors hover:text-foreground')->merge(['href' => $href]) }}>
    {{ $slot }}
</a>
