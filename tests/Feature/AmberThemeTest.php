<?php

test('Amber theme exposes the required semantic design tokens', function () {
    $theme = file_get_contents(resource_path('css/theme.css'));
    $colorTokens = [
        'background',
        'foreground',
        'card',
        'card-foreground',
        'popover',
        'popover-foreground',
        'primary',
        'primary-foreground',
        'secondary',
        'secondary-foreground',
        'muted',
        'muted-foreground',
        'accent',
        'accent-foreground',
        'destructive',
        'destructive-foreground',
        'border',
        'input',
        'ring',
        'chart-1',
        'chart-2',
        'chart-3',
        'chart-4',
        'chart-5',
        'sidebar',
        'sidebar-foreground',
        'sidebar-primary',
        'sidebar-primary-foreground',
        'sidebar-accent',
        'sidebar-accent-foreground',
        'sidebar-border',
        'sidebar-ring',
    ];

    expect($theme)
        ->toContain(':root')
        ->toContain('.dark')
        ->toContain('--background: oklch(1.0000 0 0);')
        ->toContain('--background: oklch(0.2046 0 0);')
        ->toContain('--primary: oklch(0.7686 0.1647 70.0804);')
        ->toContain('--font-sans: Inter, sans-serif;')
        ->toContain('--font-serif: Source Serif 4, serif;')
        ->toContain('--font-mono: JetBrains Mono, monospace;')
        ->toContain('--radius-lg: var(--radius);')
        ->toContain('--shadow-xl: var(--shadow-xl);');

    foreach ($colorTokens as $token) {
        expect($theme)->toContain("--color-{$token}: var(--{$token});");
    }
});

test('application stylesheet uses project-owned theme and component styles', function () {
    $stylesheet = file_get_contents(resource_path('css/app.css'));

    expect($stylesheet)
        ->toContain("@import './theme.css';")
        ->toContain('@custom-variant dark (&:is(.dark *));')
        ->not->toContain('livewire/flux')
        ->not->toContain('data-flux');
});
