@props([
    'variant' => 'section',
    'as' => null,
])

@php
    $variants = [
        'page' => ['element' => 'h1', 'classes' => 'scroll-m-20 text-3xl font-semibold tracking-tight text-foreground sm:text-4xl'],
        'section' => ['element' => 'h2', 'classes' => 'scroll-m-20 text-2xl font-semibold tracking-tight text-foreground'],
        'subsection' => ['element' => 'h3', 'classes' => 'scroll-m-20 text-xl font-semibold tracking-tight text-foreground'],
        'description' => ['element' => 'p', 'classes' => 'text-sm leading-6 text-muted-foreground'],
    ];
    $heading = $variants[$variant] ?? $variants['section'];
    $element = in_array($as, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p'], true) ? $as : $heading['element'];
@endphp

@switch($element)
    @case('h1')
        <h1 {{ $attributes->class($heading['classes']) }}>{{ $slot }}</h1>
        @break
    @case('h2')
        <h2 {{ $attributes->class($heading['classes']) }}>{{ $slot }}</h2>
        @break
    @case('h3')
        <h3 {{ $attributes->class($heading['classes']) }}>{{ $slot }}</h3>
        @break
    @case('h4')
        <h4 {{ $attributes->class($heading['classes']) }}>{{ $slot }}</h4>
        @break
    @case('h5')
        <h5 {{ $attributes->class($heading['classes']) }}>{{ $slot }}</h5>
        @break
    @case('h6')
        <h6 {{ $attributes->class($heading['classes']) }}>{{ $slot }}</h6>
        @break
    @default
        <p {{ $attributes->class($heading['classes']) }}>{{ $slot }}</p>
@endswitch
