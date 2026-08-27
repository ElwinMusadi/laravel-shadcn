@props([
    'navigation' => [],
    'workspaces' => [],
    'mobile' => false,
])

@php
    $sidebarId = $mobile ? 'application-sidebar-mobile' : 'application-sidebar';
@endphp

<aside
    aria-label="{{ __('Application sidebar') }}"
    @if (! $mobile) x-bind:class="sidebarExpanded ? 'w-[var(--app-sidebar-expanded)]' : 'w-[var(--app-sidebar-collapsed)]'" @endif
    {{ $attributes->class([
        'flex shrink-0 flex-col border-sidebar-border bg-sidebar text-sidebar-foreground transition-[width] duration-200 ease-linear',
        'hidden min-h-svh lg:flex' => ! $mobile,
        'h-full w-full' => $mobile,
    ]) }}
    data-test="{{ $sidebarId }}"
>
    <div class="flex shrink-0 flex-col gap-3 border-b border-sidebar-border p-3" data-test="{{ $sidebarId }}-header">
        <x-app.workspace-switcher :id="$sidebarId.'-workspace-switcher'" :workspaces="$workspaces" :mobile="$mobile" />
    </div>

    <div class="min-h-0 flex-1 overflow-y-auto p-3" data-test="{{ $sidebarId }}-content">
        <x-app.navigation :groups="$navigation" :mobile="$mobile" />
    </div>

    <div class="shrink-0 border-t border-sidebar-border p-3" data-test="{{ $sidebarId }}-footer">
        <x-app.user-menu :id="$sidebarId.'-user-menu'" :mobile="$mobile" sidebar />
    </div>
</aside>
