@props([
    'navigation' => [],
    'workspaces' => [],
])

<header class="sticky top-0 z-40 border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/80" data-test="application-header">
    <div class="flex min-h-16 items-center gap-3 px-4 sm:px-6 lg:px-8">
        <div class="lg:hidden">
            <x-ui.sheet id="application-navigation">
                <x-ui.sheet.trigger variant="ghost" size="sm" aria-label="{{ __('Open navigation') }}" data-test="application-navigation-trigger">
                    {{ __('Menu') }}
                </x-ui.sheet.trigger>

                <x-ui.sheet.content side="left" class="p-0">
                    <x-ui.sheet.header class="border-b border-border p-4">
                        <div class="flex items-center justify-between gap-4">
                            <x-ui.sheet.title>{{ __('Navigation') }}</x-ui.sheet.title>
                            <x-ui.sheet.close />
                        </div>
                        <x-ui.sheet.description class="sr-only">{{ __('Application navigation') }}</x-ui.sheet.description>
                    </x-ui.sheet.header>

                    <x-app.sidebar :navigation="$navigation" :workspaces="$workspaces" mobile />
                </x-ui.sheet.content>
            </x-ui.sheet>
        </div>

        <x-app.brand class="lg:hidden" />

        <div class="hidden items-center gap-3 lg:flex">
            <x-ui.button
                variant="ghost"
                size="icon"
                x-bind:aria-label="sidebarExpanded ? 'Collapse sidebar' : 'Expand sidebar'"
                x-bind:title="sidebarExpanded ? 'Collapse sidebar' : 'Expand sidebar'"
                @click="sidebarExpanded = ! sidebarExpanded"
                data-test="application-sidebar-trigger"
            >
                <span aria-hidden="true" x-text="sidebarExpanded ? '‹' : '›'"></span>
                <span class="sr-only">{{ __('Toggle sidebar') }}</span>
            </x-ui.button>

            <x-ui.separator orientation="vertical" class="h-5" />
        </div>
    </div>
</header>
