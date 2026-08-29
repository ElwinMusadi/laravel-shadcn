@props([
    'orientation' => 'horizontal',
])

@php
  $isHorizontal = $orientation === 'horizontal';

  $classes = $isHorizontal
      ? 'inline-flex items-center justify-center -space-x-px [&>*]:rounded-none [&>:first-child]:rounded-l-md [&>:last-child]:rounded-r-md [&>*:focus-visible]:z-10'
      : 'inline-flex flex-col items-stretch justify-center -space-y-px [&>*]:rounded-none [&>:first-child]:rounded-t-md [&>:last-child]:rounded-b-md [&>*:focus-visible]:z-10';
@endphp

<div {{ $attributes->class([$classes]) }} role="group" @if (!$isHorizontal) aria-orientation="vertical" @endif>
  {{ $slot }}
</div>
