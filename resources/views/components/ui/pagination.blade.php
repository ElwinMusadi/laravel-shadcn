@props(['label' => 'Pagination'])

<nav {{ $attributes->class('flex w-full justify-center')->merge(['aria-label' => $label]) }}>
    <ul class="flex items-center gap-1">
        {{ $slot }}
    </ul>
</nav>
