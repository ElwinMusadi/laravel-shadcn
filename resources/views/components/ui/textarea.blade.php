@props(['invalid' => false])

@php
    $textareaAttributes = $invalid ? $attributes->except('aria-invalid') : $attributes;
@endphp

<textarea
    @if ($invalid) aria-invalid="true" @endif
    {{ $textareaAttributes->class('flex min-h-24 w-full min-w-0 resize-y rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 read-only:cursor-default read-only:bg-muted/50 aria-invalid:border-destructive aria-invalid:ring-destructive/20 md:text-sm')->merge(['rows' => 4]) }}
>{{ $slot }}</textarea>
