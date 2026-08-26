@props([
    'variant' => 'default',
    'size' => 'default',
])

@php
    $variants = [
        'default' => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
        'secondary' => 'bg-secondary text-secondary-foreground shadow-xs hover:bg-secondary/80',
        'destructive' => 'bg-destructive text-destructive-foreground shadow-xs hover:bg-destructive/90',
        'outline' => 'border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
        'link' => 'text-primary underline-offset-4 hover:underline',
    ];

    $sizes = [
        'sm' => 'h-8 rounded-md px-3 text-xs',
        'default' => 'h-9 rounded-md px-4 py-2',
        'lg' => 'h-10 rounded-md px-6',
        'icon' => 'size-9 rounded-md',
    ];
@endphp

<button
    {{ $attributes->class([
        'inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:pointer-events-none disabled:opacity-50',
        $variants[$variant] ?? $variants['default'],
        $sizes[$size] ?? $sizes['default'],
    ])->merge(['type' => 'button']) }}
>
    {{ $slot }}
</button>
