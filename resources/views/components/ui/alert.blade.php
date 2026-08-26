@props(['variant' => 'default'])

@php
    $variants = [
        'default' => 'border-border bg-background text-foreground',
        'destructive' => 'border-destructive/50 text-destructive',
    ];
@endphp

<div
    role="alert"
    {{ $attributes->class([
        'flex w-full gap-3 rounded-lg border p-4 text-sm',
        $variants[$variant] ?? $variants['default'],
    ]) }}
>
    @isset($icon)
        <div class="shrink-0 pt-0.5" aria-hidden="true">
            {{ $icon }}
        </div>
    @endisset

    <div class="min-w-0 flex-1">
        {{ $slot }}
    </div>
</div>
