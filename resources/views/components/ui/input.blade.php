@props(['invalid' => false])

@php
  $inputAttributes = $invalid ? $attributes->except('aria-invalid') : $attributes;
@endphp

<input @if ($invalid) aria-invalid="true" @endif
  {{ $inputAttributes->class('flex h-9 w-full min-w-0 rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-2 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 read-only:cursor-default read-only:bg-muted/50 aria-invalid:border-destructive aria-invalid:ring-destructive/20 md:text-sm')->merge(['type' => 'text']) }}>
