@props([
    'id' => 'application-user-menu',
    'sidebar' => false,
    'mobile' => false,
])

@php
    $user = auth()->user();
    $collapsedControlClass = $mobile ? '{}' : "{ '!justify-center !px-0': ! sidebarExpanded }";
@endphp

@if ($user)
    <x-ui.dropdown id="{{ $id }}" class="{{ $sidebar ? 'w-full' : '' }}" data-test="{{ $id }}">
        @if ($sidebar)
            <x-ui.dropdown.trigger
                variant="ghost"
                size="default"
                class="w-full justify-start px-2 text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
                x-bind:class="{{ $collapsedControlClass }}"
                aria-label="{{ __('Open user menu for :name', ['name' => $user->name]) }}"
                title="{{ $user->name }}"
                data-test="{{ $id }}-trigger"
            >
                <x-ui.avatar class="size-8">
                    <x-ui.avatar.fallback aria-hidden="true">{{ $user->initials() }}</x-ui.avatar.fallback>
                </x-ui.avatar>

                <span @if (! $mobile) x-show="sidebarExpanded" @endif class="min-w-0 flex-1 text-left">
                    <span class="block truncate text-sm font-medium">{{ $user->name }}</span>
                    <span class="block truncate text-xs text-sidebar-foreground/70">{{ $user->email }}</span>
                </span>

                <span @if (! $mobile) x-show="sidebarExpanded" @endif class="text-sm text-sidebar-foreground/70" aria-hidden="true">↕</span>
            </x-ui.dropdown.trigger>
        @else
            <x-ui.dropdown.trigger variant="ghost" size="icon" aria-label="{{ __('Open user menu for :name', ['name' => $user->name]) }}" data-test="{{ $id }}-trigger">
                <x-ui.avatar class="size-8">
                    <x-ui.avatar.fallback aria-hidden="true">{{ $user->initials() }}</x-ui.avatar.fallback>
                </x-ui.avatar>
            </x-ui.dropdown.trigger>
        @endif

        <x-ui.dropdown.content :align="$sidebar ? 'start' : 'end'" @class(['bottom-full mb-2 !mt-0 w-64' => $sidebar]) data-test="{{ $id }}-content">
            <div class="flex items-center gap-3 px-2 py-1.5" role="presentation">
                <x-ui.avatar class="size-9">
                    <x-ui.avatar.fallback>{{ $user->initials() }}</x-ui.avatar.fallback>
                </x-ui.avatar>

                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-foreground">{{ $user->name }}</p>
                    <p class="truncate text-xs text-muted-foreground">{{ $user->email }}</p>
                </div>
            </div>

            <x-ui.dropdown.separator />

            <x-ui.dropdown.group>
                <x-ui.dropdown.item href="{{ route('profile.edit') }}" wire:navigate>
                    {{ __('Settings') }}
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>

            <x-ui.dropdown.separator />

            <form method="POST" action="{{ route('logout') }}" data-test="logout-form">
                @csrf

                <x-ui.dropdown.item type="submit" data-test="logout-button">
                    {{ __('Log out') }}
                </x-ui.dropdown.item>
            </form>
        </x-ui.dropdown.content>
    </x-ui.dropdown>
@endif
