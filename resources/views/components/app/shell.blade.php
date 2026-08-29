@props([
    'title' => null,
    'description' => null,
    'breadcrumbs' => [],
    'showPageHeader' => false,
    'navigation' => null,
    'workspaces' => null,
])

@php
  $navigation ??= [
      [
          'key' => 'main',
          'quickActions' => true,
          'items' => [
              ['key' => 'dashboard', 'label' => __('Dashboard'), 'icon' => 'layout-dashboard', 'route' => 'dashboard', 'active' => ['dashboard']],
              ['key' => 'lifecycle', 'label' => __('Lifecycle'), 'icon' => 'list-todo', 'href' => '#main-content'],
              ['key' => 'analytics', 'label' => __('Analytics'), 'icon' => 'chart-column', 'href' => '#main-content'],
              ['key' => 'projects', 'label' => __('Projects'), 'icon' => 'folder', 'href' => '#main-content'],
              ['key' => 'team', 'label' => __('Team'), 'icon' => 'users', 'href' => '#main-content'],
          ],
      ],
      [
          'key' => 'documents',
          'label' => __('Documents'),
          'items' => [
              ['key' => 'data-library', 'label' => __('Data Library'), 'icon' => 'database', 'route' => 'ui.playground', 'active' => ['ui.playground', 'ui.playground.*', 'ui.components']],
              ['key' => 'reports', 'label' => __('Reports'), 'icon' => 'chart-no-axes-column', 'href' => '#main-content'],
              ['key' => 'word-assistant', 'label' => __('Word Assistant'), 'icon' => 'file-text', 'href' => '#main-content'],
              ['key' => 'more', 'label' => __('More'), 'icon' => 'ellipsis', 'href' => '#main-content'],
          ],
      ],
      [
          'key' => 'secondary',
          'position' => 'bottom',
          'items' => [
              ['key' => 'settings', 'label' => __('Settings'), 'icon' => 'settings', 'route' => 'profile.edit', 'active' => ['profile.*', 'appearance.*', 'security.*']],
              ['key' => 'get-help', 'label' => __('Get Help'), 'icon' => 'circle-help', 'route' => 'ui.playground.interaction', 'active' => ['ui.playground.interaction']],
              ['key' => 'search', 'label' => __('Search'), 'icon' => 'search', 'href' => '#main-content'],
          ],
      ],
  ];

  $workspaces ??= [
      [
          'key' => 'starter',
          'name' => config('app.name', 'Laravel'),
          'plan' => __('Starter Kit'),
      ],
  ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('partials.head')
</head>

<body class="min-h-screen bg-background text-foreground antialiased">
  <a href="#main-content" class="sr-only z-50 rounded-md bg-primary px-3 py-2 text-sm font-medium text-primary-foreground focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
    {{ __('Skip to main content') }}
  </a>

  <div class="flex min-h-svh [--app-sidebar-expanded:16rem] lg:gap-2 lg:bg-muted/40 lg:p-2" x-data="{ sidebarExpanded: true }"
    @keydown.window="if (($event.ctrlKey || $event.metaKey) && $event.key.toLowerCase() === 'b' && ! ['INPUT', 'SELECT', 'TEXTAREA'].includes($event.target.tagName) && ! $event.target.isContentEditable) { $event.preventDefault(); sidebarExpanded = ! sidebarExpanded }" data-test="application-shell">
    <x-app.sidebar :navigation="$navigation" :workspaces="$workspaces" />

    <div class="flex min-w-0 flex-1 flex-col bg-background lg:rounded-xl lg:border lg:border-border">
      <x-app.header :navigation="$navigation" :title="$title" :breadcrumbs="$breadcrumbs" :workspaces="$workspaces" />

      <main id="main-content" tabindex="-1" @class([
          'flex w-full flex-1 flex-col outline-none',
          'gap-6 px-4 py-6 sm:px-6 lg:px-8 lg:py-8' => $showPageHeader,
      ]) data-test="application-main">
        @if ($showPageHeader)
          <x-app.page-header :title="$title" :description="$description" />
        @endif

        {{ $slot }}
      </main>
    </div>
  </div>

  <x-app.toast />

  @livewireScripts
</body>

</html>
