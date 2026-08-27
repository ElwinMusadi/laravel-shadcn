<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head', ['title' => __('Welcome')])
    </head>
    <body class="min-h-screen bg-background text-foreground antialiased">
        <main class="mx-auto flex min-h-svh w-full max-w-5xl items-center px-4 py-10 sm:px-6 lg:px-8">
            <x-ui.card class="grid w-full overflow-hidden p-0 lg:grid-cols-[minmax(0,1fr)_minmax(18rem,0.72fr)]">
                <section class="flex min-w-0 flex-col gap-8 p-6 sm:p-10">
                    <x-app.brand />

                    <div class="flex max-w-xl flex-col gap-4">
                        <p class="text-sm font-medium text-primary">{{ __('Laravel Shadcn UI Starter') }}</p>
                        <h1 class="text-balance text-3xl font-semibold tracking-tight text-foreground sm:text-4xl">
                            {{ __('A Blade-native workspace built for clear, focused work.') }}
                        </h1>
                        <p class="max-w-lg text-sm leading-6 text-muted-foreground sm:text-base">
                            {{ __('Sign in to access the application shell, dashboard, settings, and reusable UI components.') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        @auth
                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow-xs outline-none transition-colors hover:bg-primary/90 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background"
                            >
                                {{ __('Open dashboard') }}
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow-xs outline-none transition-colors hover:bg-primary/90 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background"
                            >
                                {{ __('Log in') }}
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex h-9 items-center justify-center rounded-md border border-input bg-background px-4 py-2 text-sm font-medium text-foreground shadow-xs outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background"
                                >
                                    {{ __('Create account') }}
                                </a>
                            @endif
                        @endauth
                    </div>
                </section>

                <aside class="flex min-h-64 flex-col justify-between gap-8 bg-primary p-6 text-primary-foreground sm:p-10">
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-foreground/70">
                        {{ __('Amber workspace') }}
                    </p>

                    <div class="flex flex-col gap-3">
                        <p class="text-2xl font-semibold leading-tight">
                            {{ __('One theme preference, shared everywhere.') }}
                        </p>
                        <p class="text-sm leading-6 text-primary-foreground/80">
                            {{ __('Light is the default. Dark is available when you choose it.') }}
                        </p>
                    </div>
                </aside>
            </x-ui.card>
        </main>
    </body>
</html>
