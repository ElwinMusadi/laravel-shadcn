@props(['label' => 'Breadcrumb'])

<nav {{ $attributes->class('')->merge(['aria-label' => $label]) }}>
  <ol class="flex flex-wrap items-center gap-1.5 wrap-break-word text-md text-muted-foreground sm:gap-2.5">
    {{ $slot }}
  </ol>
</nav>
