<header class="sticky top-0 z-40 border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/80" data-test="application-header">
    <div class="mx-auto flex min-h-16 max-w-7xl items-center gap-3 px-4 sm:px-6 lg:px-8">
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

                    <div class="flex flex-1 flex-col gap-6 p-4">
                        <x-app.brand />
                        <x-app.navigation />
                    </div>
                </x-ui.sheet.content>
            </x-ui.sheet>
        </div>

        <x-app.brand />

        <div class="hidden lg:block">
            <x-app.navigation />
        </div>

        <div class="ms-auto">
            <x-app.user-menu />
        </div>
    </div>
</header>
