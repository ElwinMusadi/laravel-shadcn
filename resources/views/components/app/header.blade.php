@props([
    'navigation' => [],
    'title' => null,
    'workspaces' => [],
])

<header class="sticky top-0 z-40 border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/80" data-test="application-header">
    <div class="flex h-12 items-center gap-2 px-4 lg:px-6">
        <div class="lg:hidden">
            <x-ui.sheet id="application-navigation">
                <x-ui.sheet.trigger variant="ghost" size="icon" aria-label="{{ __('Open navigation') }}" data-test="application-navigation-trigger">
                    <x-ui.icon name="panel-left" class="size-4" />
                    <span class="sr-only">{{ __('Open navigation') }}</span>
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

        <div class="hidden items-center gap-2 lg:flex">
            <x-ui.button
                variant="ghost"
                size="icon"
                aria-controls="application-sidebar"
                aria-label="{{ __('Toggle sidebar') }}"
                x-bind:aria-expanded="sidebarExpanded"
                @click="sidebarExpanded = ! sidebarExpanded"
                data-test="application-sidebar-trigger"
            >
                <x-ui.icon name="panel-left" class="size-4" />
                <span class="sr-only">{{ __('Toggle sidebar') }}</span>
            </x-ui.button>

            <x-ui.separator orientation="vertical" class="mx-1 h-4" />
        </div>

        <h1 class="text-base font-medium text-foreground">{{ $title ?? config('app.name', 'Laravel') }}</h1>

        <div class="ml-auto flex items-center gap-2">
            <x-app.theme-toggle />
        </div>
    </div>
</header>
