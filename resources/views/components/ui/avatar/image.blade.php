@props([
    'src' => null,
    'alt' => '',
])

<img
    {{ $attributes->class('absolute inset-0 aspect-square size-full object-cover')->merge([
        'src' => $src,
        'alt' => $alt,
        'onerror' => "this.classList.add('hidden')",
    ]) }}
>
