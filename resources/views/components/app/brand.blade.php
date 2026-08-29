@props([
    'href' => null,
    'sidebar' => false,
])

@php
  $href ??= route('dashboard');
  $classes = $sidebar
      ? 'flex h-9 w-full min-w-0 items-center gap-2 rounded-lg px-2 text-sidebar-foreground outline-none transition-colors focus-visible:ring-2 focus-visible:ring-sidebar-ring focus-visible:ring-offset-2 focus-visible:ring-offset-sidebar'
      : 'inline-flex items-center gap-2 rounded-md text-sm font-semibold text-foreground outline-none transition-colors focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background';
@endphp

<a href="{{ $href }}" wire:navigate {{ $attributes->class($classes) }}>
  <span @class([
      'flex items-center justify-center rounded-md bg-primary text-primary-foreground shadow-sm',
      'size-7 shrink-0' => $sidebar,
      'size-8' => !$sidebar,
  ]) aria-hidden="true">
    <x-app-logo-icon @class(['fill-current', 'size-4' => $sidebar, 'size-5' => !$sidebar]) />
  </span>

  @if ($sidebar)
    <span class="min-w-0 flex-1 text-left">
      <span class="block truncate text-base font-semibold leading-tight">{{ config('app.name', 'Laravel') }}</span>
      <span class="block truncate text-[10px] font-normal leading-tight"><span>Starter Kit Shadcn UI</span></span>
    </span>
  @else
    <span>{{ config('app.name', 'Laravel') }}</span>
  @endif
</a>
