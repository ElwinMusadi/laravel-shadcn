<div>
  <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
</div>
@props(['title', 'description', 'current'])

@php
  $sections = [
      ['key' => 'overview', 'label' => __('Overview'), 'route' => 'ui.playground'],
      ['key' => 'foundations', 'label' => __('Foundations'), 'route' => 'ui.playground.foundations'],
      ['key' => 'components', 'label' => __('Components'), 'route' => 'ui.components'],
      ['key' => 'components.input', 'label' => __('↳ Input'), 'route' => 'ui.components.input'],
      ['key' => 'forms', 'label' => __('Forms'), 'route' => 'ui.playground.forms'],
      ['key' => 'data', 'label' => __('Data Display'), 'route' => 'ui.playground.data-display'],
      ['key' => 'navigation', 'label' => __('Navigation'), 'route' => 'ui.playground.navigation'],
      ['key' => 'interaction', 'label' => __('Interaction'), 'route' => 'ui.playground.interaction'],
      ['key' => 'application', 'label' => __('Application'), 'route' => 'ui.playground.application'],
      ['key' => 'blocks', 'label' => __('Blocks'), 'route' => 'ui.playground.blocks'],
      ['key' => 'authentication', 'label' => __('Authentication'), 'route' => 'ui.playground.authentication'],
  ];

  $breadcrumbs = [['label' => __('Dashboard'), 'route' => 'dashboard']];

  if ($current !== 'overview') {
      $breadcrumbs[] = ['label' => __('UI Playground'), 'route' => 'ui.playground'];
  }

  // For nested sections like components.input, add parent breadcrumb
  if (str_contains($current, '.')) {
      $parentKey = explode('.', $current)[0];
      $parentSection = collect($sections)->firstWhere('key', $parentKey);
      if ($parentSection) {
          $breadcrumbs[] = ['label' => $parentSection['label'], 'route' => $parentSection['route']];
      }
  }

  $breadcrumbs[] = ['label' => $title];
@endphp

<x-layouts::app :title="$title" :description="$description" :breadcrumbs="$breadcrumbs" :show-page-header="true">
  <div class="grid min-w-0 gap-6 lg:grid-cols-[13rem_minmax(0,1fr)]">
    <aside class="h-fit rounded-xl border border-border bg-card p-3 text-card-foreground lg:sticky lg:top-24" aria-label="{{ __('Playground navigation') }}">
      <nav class="flex flex-col gap-1" aria-label="{{ __('UI Playground sections') }}">
        @foreach ($sections as $section)
          @php($isCurrent = $section['key'] === $current)

          <a href="{{ route($section['route']) }}" wire:navigate @if ($isCurrent) aria-current="page" @endif @class([
              'rounded-md px-3 py-2 text-sm font-medium outline-none transition-colors focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-card',
              'bg-accent text-accent-foreground' => $isCurrent,
              'text-muted-foreground hover:bg-muted hover:text-foreground' => !$isCurrent,
          ])>
            {{ $section['label'] }}
          </a>
        @endforeach
      </nav>
    </aside>

    <div class="flex min-w-0 flex-col gap-8">
      {{ $slot }}
    </div>
  </div>
</x-layouts::app>
