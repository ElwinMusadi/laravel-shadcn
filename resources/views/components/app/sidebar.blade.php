@props([
    'navigation' => [],
    'workspaces' => [],
    'mobile' => false,
])

@php
  $sidebarId = $mobile ? 'application-sidebar-mobile' : 'application-sidebar';
@endphp

<aside aria-label="{{ __('Application sidebar') }}" @if (!$mobile) x-cloak x-show="sidebarExpanded" x-transition.opacity x-bind:data-state="sidebarExpanded ? 'open' : 'closed'" @endif
  {{ $attributes->class(['flex shrink-0 flex-col border-sidebar-border bg-sidebar text-sidebar-foreground', 'hidden sticky top-2 h-[calc(100svh-1rem)] w-[var(--app-sidebar-expanded)] border lg:flex lg:rounded-xl' => !$mobile, 'flex-1 min-h-0 w-full' => $mobile]) }}
  data-test="{{ $sidebarId }}">
  <div class="flex shrink-0 flex-col border-b border-sidebar-border p-2" data-test="{{ $sidebarId }}-header">
    <x-app.workspace-switcher :id="$sidebarId . '-workspace-switcher'" :workspaces="$workspaces" :mobile="$mobile" />
  </div>

  <div class="min-h-0 flex-1 overflow-y-auto p-2" data-test="{{ $sidebarId }}-content">
    <x-app.navigation :groups="$navigation" :mobile="$mobile" />
  </div>

  <div class="shrink-0 border-t border-sidebar-border p-2" data-test="{{ $sidebarId }}-footer">
    <x-app.user-menu :id="$sidebarId . '-user-menu'" :mobile="$mobile" sidebar />
  </div>
</aside>
