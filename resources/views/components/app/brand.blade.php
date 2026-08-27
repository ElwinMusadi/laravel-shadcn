@props([
    'href' => null,
])

@php
    $href ??= route('dashboard');
@endphp

<a
    href="{{ $href }}"
    wire:navigate
    {{ $attributes->class('inline-flex items-center gap-2 rounded-md text-sm font-semibold text-foreground outline-none transition-colors focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background') }}
>
    <span class="flex size-8 items-center justify-center rounded-md bg-primary text-primary-foreground shadow-sm">
        <x-app-logo-icon class="size-5 fill-current" />
    </span>

    <span>{{ config('app.name', 'Laravel') }}</span>
</a>
