@props([
    'title',
    'description',
    'id' => null,
])

<div {{ $attributes->class('flex w-full flex-col gap-2 text-center') }}>
    <h1 @if ($id) id="{{ $id }}" @endif class="text-2xl font-semibold tracking-tight text-balance sm:text-3xl">
        {{ $title }}
    </h1>
    <p class="text-sm leading-6 text-muted-foreground">
        {{ $description }}
    </p>
</div>
