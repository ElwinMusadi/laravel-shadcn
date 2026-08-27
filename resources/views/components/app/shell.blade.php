@props([
    'title' => null,
    'description' => null,
    'breadcrumbs' => [],
    'showPageHeader' => false,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-background text-foreground antialiased">
        <a href="#main-content" class="sr-only z-50 rounded-md bg-primary px-3 py-2 text-sm font-medium text-primary-foreground focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
            {{ __('Skip to main content') }}
        </a>

        <div class="min-h-svh">
            <x-app.header />

            <main id="main-content" tabindex="-1" class="mx-auto flex w-full max-w-7xl flex-1 flex-col gap-6 px-4 py-6 outline-none sm:px-6 lg:px-8 lg:py-8" data-test="application-main">
                @if ($showPageHeader)
                    <x-app.page-header :title="$title" :description="$description" :breadcrumbs="$breadcrumbs" />
                @endif

                {{ $slot }}
            </main>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
