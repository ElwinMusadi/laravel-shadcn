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
            'label' => __('Main'),
            'items' => [
                [
                    'key' => 'dashboard',
                    'label' => __('Dashboard'),
                    'icon' => 'D',
                    'route' => 'dashboard',
                    'active' => ['dashboard'],
                ],
            ],
        ],
        [
            'key' => 'resources',
            'label' => __('Resources'),
            'items' => [
                [
                    'key' => 'library',
                    'label' => __('Library'),
                    'icon' => 'L',
                    'children' => [
                        [
                            'key' => 'ui-components',
                            'label' => __('UI Components'),
                            'route' => 'ui.components',
                            'active' => ['ui.components'],
                        ],
                    ],
                ],
            ],
        ],
        [
            'key' => 'account',
            'label' => __('Account'),
            'items' => [
                [
                    'key' => 'settings',
                    'label' => __('Settings'),
                    'icon' => 'S',
                    'children' => [
                        [
                            'key' => 'profile',
                            'label' => __('Profile'),
                            'route' => 'profile.edit',
                            'active' => ['profile.*'],
                        ],
                        [
                            'key' => 'appearance',
                            'label' => __('Appearance'),
                            'route' => 'appearance.edit',
                            'active' => ['appearance.*'],
                        ],
                        [
                            'key' => 'security',
                            'label' => __('Security'),
                            'route' => 'security.edit',
                            'active' => ['security.*'],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $workspaces ??= [
        [
            'key' => 'starter',
            'name' => config('app.name', 'Laravel'),
            'plan' => __('Starter'),
            'initials' => 'LS',
        ],
        [
            'key' => 'studio',
            'name' => __('Studio'),
            'plan' => __('Demo'),
            'initials' => 'ST',
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-background text-foreground antialiased">
        <a href="#main-content" class="sr-only z-50 rounded-md bg-primary px-3 py-2 text-sm font-medium text-primary-foreground focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
            {{ __('Skip to main content') }}
        </a>

        <div
            class="flex min-h-svh [--app-sidebar-collapsed:4.5rem] [--app-sidebar-expanded:16rem]"
            x-data="{ sidebarExpanded: true }"
            @keydown.window="if (($event.ctrlKey || $event.metaKey) && $event.key.toLowerCase() === 'b' && ! ['INPUT', 'SELECT', 'TEXTAREA'].includes($event.target.tagName) && ! $event.target.isContentEditable) { $event.preventDefault(); sidebarExpanded = ! sidebarExpanded }"
            data-test="application-shell"
        >
            <x-app.sidebar :navigation="$navigation" :workspaces="$workspaces" />

            <div class="flex min-w-0 flex-1 flex-col">
                <x-app.header :navigation="$navigation" :workspaces="$workspaces" />

                <main id="main-content" tabindex="-1" class="mx-auto flex w-full max-w-7xl flex-1 flex-col gap-6 px-4 py-6 outline-none sm:px-6 lg:px-8 lg:py-8" data-test="application-main">
                    @if ($showPageHeader)
                        <x-app.page-header :title="$title" :description="$description" :breadcrumbs="$breadcrumbs" />
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
