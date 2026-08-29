@props([
    'navigation' => [],
    'mobile' => false,
])

@php
  $sidebarId = $mobile ? 'application-sidebar-mobile' : 'application-sidebar';
@endphp

<aside id="{{ $sidebarId }}" aria-label="{{ __('Application sidebar') }}" @if (!$mobile) x-bind:data-state="sidebarExpanded ? 'open' : 'closed'" x-bind:aria-hidden="(! sidebarExpanded).toString()" x-bind:inert="! sidebarExpanded" @endif
  {{ $attributes->class([
      'flex shrink-0 flex-col min-h-0 border-sidebar-border bg-sidebar text-sidebar-foreground',
      'hidden sticky top-2 h-[calc(100svh-1rem)] border lg:flex lg:overflow-hidden lg:rounded-xl lg:[--app-sidebar-width:var(--app-sidebar-expanded)] lg:[--app-sidebar-translate-x:0rem] lg:[--app-sidebar-opacity:1] lg:w-[var(--app-sidebar-width)] lg:translate-x-[var(--app-sidebar-translate-x)] lg:opacity-[var(--app-sidebar-opacity)] lg:transition-[width,transform,opacity] lg:duration-200 lg:ease-linear motion-reduce:transition-none data-[state=closed]:[--app-sidebar-width:0rem] data-[state=closed]:[--app-sidebar-translate-x:calc(var(--app-sidebar-expanded)*-1)] data-[state=closed]:[--app-sidebar-opacity:0] data-[state=closed]:pointer-events-none' => !$mobile,
      'flex-1 w-full' => $mobile,
  ]) }} data-test="{{ $sidebarId }}">
  <div class="flex shrink-0 flex-col border-b border-sidebar-border p-2" data-test="{{ $sidebarId }}-header">
    <x-app.brand sidebar data-test="{{ $sidebarId }}-brand" />
  </div>

  <div class="min-h-0 flex-1 overflow-y-auto p-2" data-test="{{ $sidebarId }}-content">
    <x-app.navigation :groups="$navigation" :mobile="$mobile" />
  </div>

  <div class="shrink-0 border-t border-sidebar-border p-2" data-test="{{ $sidebarId }}-footer">
    <x-app.user-menu :id="$sidebarId . '-user-menu'" :mobile="$mobile" sidebar />
  </div>
</aside>
