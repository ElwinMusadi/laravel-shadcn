@props([
    'id' => 'application-workspace-switcher',
    'workspaces' => [],
    'mobile' => false,
])

@php
    $activeWorkspace = $workspaces[0] ?? null;
    $collapsedControlClass = $mobile ? '{}' : "{ '!justify-center !px-0': ! sidebarExpanded }";
@endphp

@if ($activeWorkspace)
    <div x-data="{ activeWorkspace: @js($activeWorkspace), workspaces: @js(array_values($workspaces)) }">
        <x-ui.dropdown id="{{ $id }}" class="w-full" data-test="{{ $id }}">
            <x-ui.dropdown.trigger
                variant="ghost"
                size="default"
                class="w-full justify-start px-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
                x-bind:class="{{ $collapsedControlClass }}"
                aria-label="{{ __('Switch workspace') }}"
                data-test="{{ $id }}-trigger"
            >
                <span class="flex size-8 shrink-0 items-center justify-center rounded-md bg-sidebar-primary text-xs font-semibold text-sidebar-primary-foreground" aria-hidden="true" x-text="activeWorkspace.initials"></span>
                <span @if (! $mobile) x-show="sidebarExpanded" @endif class="min-w-0 flex-1 text-left">
                    <span class="block truncate text-sm font-semibold" x-text="activeWorkspace.name"></span>
                    <span class="block truncate text-xs text-sidebar-foreground/70" x-text="activeWorkspace.plan"></span>
                </span>
                <span @if (! $mobile) x-show="sidebarExpanded" @endif class="text-sm text-sidebar-foreground/70" aria-hidden="true">↕</span>
            </x-ui.dropdown.trigger>

            <x-ui.dropdown.content align="start" class="min-w-56" data-test="{{ $id }}-content">
                <p class="px-2 py-1.5 text-xs font-medium text-muted-foreground">{{ __('Workspaces') }}</p>

                <x-ui.dropdown.group>
                    @foreach ($workspaces as $workspace)
                        <x-ui.dropdown.item @click="activeWorkspace = workspaces[{{ $loop->index }}]" data-test="{{ $id }}-item-{{ $workspace['key'] ?? $loop->index }}">
                            <span class="flex size-6 items-center justify-center rounded-md bg-sidebar-accent text-xs font-semibold text-sidebar-accent-foreground" aria-hidden="true">
                                {{ $workspace['initials'] ?? mb_strtoupper(mb_substr($workspace['name'], 0, 1)) }}
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block truncate">{{ $workspace['name'] }}</span>
                                <span class="block truncate text-xs text-muted-foreground">{{ $workspace['plan'] ?? '' }}</span>
                            </span>
                        </x-ui.dropdown.item>
                    @endforeach
                </x-ui.dropdown.group>
            </x-ui.dropdown.content>
        </x-ui.dropdown>
    </div>
@endif
