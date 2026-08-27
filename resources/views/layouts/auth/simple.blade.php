<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-background text-foreground antialiased">
        <main class="flex min-h-svh items-center justify-center bg-muted/40 p-4 sm:p-6 md:p-10">
            <x-ui.card class="grid w-full max-w-sm overflow-hidden p-0 md:max-w-4xl md:grid-cols-[minmax(0,1fr)_minmax(0,0.82fr)]">
                <section class="flex min-w-0 flex-col p-6 sm:p-8 md:p-10">
                    <a
                        href="{{ route('home') }}"
                        class="mb-8 inline-flex self-start rounded-md outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-card"
                    >
                        <span class="flex size-9 items-center justify-center rounded-md bg-primary text-primary-foreground shadow-sm">
                            <x-app-logo-icon class="size-5 fill-current" />
                        </span>
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>

                    {{ $slot }}
                </section>

                <aside class="relative hidden overflow-hidden bg-primary p-10 text-primary-foreground md:flex md:flex-col" aria-label="{{ config('app.name', 'Laravel') }}">
                    <div class="absolute -right-20 -top-20 size-64 rounded-full bg-primary-foreground/10"></div>
                    <div class="absolute -bottom-24 -left-24 size-80 rounded-full border border-primary-foreground/20"></div>

                    <a
                        href="{{ route('home') }}"
                        class="relative inline-flex items-center gap-3 self-start rounded-md text-base font-semibold outline-none focus-visible:ring-2 focus-visible:ring-primary-foreground focus-visible:ring-offset-2 focus-visible:ring-offset-primary"
                    >
                        <span class="flex size-10 items-center justify-center rounded-md border border-primary-foreground/20 bg-primary-foreground/10">
                            <x-app-logo-icon class="size-6 fill-current" />
                        </span>
                        <span>{{ config('app.name', 'Laravel') }}</span>
                    </a>

                    <div class="relative mt-auto flex max-w-sm flex-col gap-4">
                        <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-foreground/70">
                            {{ __('Secure workspace') }}
                        </p>
                        <p class="text-balance text-2xl font-semibold leading-tight">
                            {{ __('Everything you need, with access protected by your account.') }}
                        </p>
                        <p class="max-w-xs text-sm leading-6 text-primary-foreground/80">
                            {{ __('Sign in to continue securely and manage your workspace with confidence.') }}
                        </p>
                    </div>
                </aside>
            </x-ui.card>
        </main>

        @livewireScripts
    </body>
</html>
