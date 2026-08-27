@php
    $tokens = [
        ['name' => 'background', 'class' => 'bg-background text-foreground'],
        ['name' => 'foreground', 'class' => 'bg-foreground text-background'],
        ['name' => 'card', 'class' => 'bg-card text-card-foreground'],
        ['name' => 'card-foreground', 'class' => 'bg-card-foreground text-card'],
        ['name' => 'popover', 'class' => 'bg-popover text-popover-foreground'],
        ['name' => 'popover-foreground', 'class' => 'bg-popover-foreground text-popover'],
        ['name' => 'primary', 'class' => 'bg-primary text-primary-foreground'],
        ['name' => 'primary-foreground', 'class' => 'bg-primary-foreground text-primary'],
        ['name' => 'secondary', 'class' => 'bg-secondary text-secondary-foreground'],
        ['name' => 'secondary-foreground', 'class' => 'bg-secondary-foreground text-secondary'],
        ['name' => 'muted', 'class' => 'bg-muted text-muted-foreground'],
        ['name' => 'muted-foreground', 'class' => 'bg-muted-foreground text-muted'],
        ['name' => 'accent', 'class' => 'bg-accent text-accent-foreground'],
        ['name' => 'accent-foreground', 'class' => 'bg-accent-foreground text-accent'],
        ['name' => 'destructive', 'class' => 'bg-destructive text-destructive-foreground'],
        ['name' => 'destructive-foreground', 'class' => 'bg-destructive-foreground text-destructive'],
        ['name' => 'border', 'class' => 'bg-border text-foreground'],
        ['name' => 'input', 'class' => 'bg-input text-foreground'],
        ['name' => 'ring', 'class' => 'bg-ring text-primary-foreground'],
        ['name' => 'chart-1', 'class' => 'bg-chart-1 text-primary-foreground'],
        ['name' => 'chart-2', 'class' => 'bg-chart-2 text-primary-foreground'],
        ['name' => 'chart-3', 'class' => 'bg-chart-3 text-primary-foreground'],
        ['name' => 'chart-4', 'class' => 'bg-chart-4 text-primary-foreground'],
        ['name' => 'chart-5', 'class' => 'bg-chart-5 text-primary-foreground'],
        ['name' => 'sidebar', 'class' => 'bg-sidebar text-sidebar-foreground'],
        ['name' => 'sidebar-primary', 'class' => 'bg-sidebar-primary text-sidebar-primary-foreground'],
        ['name' => 'sidebar-accent', 'class' => 'bg-sidebar-accent text-sidebar-accent-foreground'],
        ['name' => 'sidebar-border', 'class' => 'bg-sidebar-border text-sidebar-foreground'],
        ['name' => 'sidebar-ring', 'class' => 'bg-sidebar-ring text-sidebar-primary-foreground'],
    ];

    $radii = [
        ['label' => 'radius-sm', 'class' => 'rounded-sm'],
        ['label' => 'radius-md', 'class' => 'rounded-md'],
        ['label' => 'radius-lg', 'class' => 'rounded-lg'],
        ['label' => 'radius-xl', 'class' => 'rounded-xl'],
    ];

    $shadows = [
        ['label' => 'shadow-2xs', 'class' => 'shadow-2xs'],
        ['label' => 'shadow-xs', 'class' => 'shadow-xs'],
        ['label' => 'shadow-sm', 'class' => 'shadow-sm'],
        ['label' => 'shadow', 'class' => 'shadow'],
        ['label' => 'shadow-md', 'class' => 'shadow-md'],
        ['label' => 'shadow-lg', 'class' => 'shadow-lg'],
        ['label' => 'shadow-xl', 'class' => 'shadow-xl'],
        ['label' => 'shadow-2xl', 'class' => 'shadow-2xl'],
    ];
@endphp

<x-playground.layout
    :title="__('Foundations')"
    :description="__('Semantic tokens dan skala visual aktual yang diwariskan oleh seluruh komponen.')"
    current="foundations"
>
    <section class="flex flex-col gap-4" aria-labelledby="tokens-heading">
        <div class="flex flex-col gap-1">
            <x-ui.heading id="tokens-heading" variant="section">{{ __('Colors / Tokens') }}</x-ui.heading>
            <x-ui.heading variant="description">{{ __('Semua swatch di bawah menggunakan semantic utility yang sama dengan aplikasi, sehingga berubah otomatis bersama root Light atau Dark.') }}</x-ui.heading>
        </div>

        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($tokens as $token)
                <div class="overflow-hidden rounded-lg border border-border bg-card text-card-foreground">
                    <div class="h-20 {{ $token['class'] }}"></div>
                    <p class="border-t border-border px-3 py-2 font-mono text-xs text-muted-foreground">{{ $token['name'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="typography-heading">
        <x-ui.heading id="typography-heading" variant="section">{{ __('Typography') }}</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="grid gap-6 pt-6">
                <div class="flex flex-col gap-2 font-sans">
                    <p class="text-xs font-medium text-muted-foreground">font-sans</p>
                    <x-ui.heading variant="section">{{ __('Heading hierarchy menggunakan font sans') }}</x-ui.heading>
                    <p class="text-sm leading-6 text-muted-foreground">{{ __('Body text memakai token foreground dan muted-foreground, bukan nilai warna khusus Playground.') }}</p>
                </div>
                <x-ui.separator />
                <div class="flex flex-col gap-2 font-serif">
                    <p class="text-xs font-medium text-muted-foreground">font-serif</p>
                    <p class="text-2xl font-semibold text-foreground">{{ __('Source Serif 4 untuk editorial emphasis.') }}</p>
                </div>
                <x-ui.separator />
                <div class="flex flex-col gap-2 font-mono">
                    <p class="text-xs font-medium text-muted-foreground">font-mono</p>
                    <code class="text-sm text-foreground">&lt;x-ui.button variant="outline"&gt;Save&lt;/x-ui.button&gt;</code>
                </div>
            </x-ui.card.content>
        </x-ui.card>
    </section>

    <section class="grid gap-6 xl:grid-cols-2">
        <div class="flex flex-col gap-4" aria-labelledby="radius-heading">
            <x-ui.heading id="radius-heading" variant="section">{{ __('Radius') }}</x-ui.heading>
            <x-ui.card>
                <x-ui.card.content class="grid grid-cols-2 gap-4 pt-6 sm:grid-cols-4">
                    @foreach ($radii as $radius)
                        <div class="flex flex-col gap-2">
                            <div class="h-16 border border-border bg-primary {{ $radius['class'] }}"></div>
                            <code class="font-mono text-xs text-muted-foreground">{{ $radius['label'] }}</code>
                        </div>
                    @endforeach
                </x-ui.card.content>
            </x-ui.card>
        </div>

        <div class="flex flex-col gap-4" aria-labelledby="shadows-heading">
            <x-ui.heading id="shadows-heading" variant="section">{{ __('Shadows') }}</x-ui.heading>
            <x-ui.card>
                <x-ui.card.content class="grid grid-cols-2 gap-5 pt-6 sm:grid-cols-3">
                    @foreach ($shadows as $shadow)
                        <div class="rounded-lg border border-border bg-card p-4 {{ $shadow['class'] }}">
                            <code class="font-mono text-xs text-muted-foreground">{{ $shadow['label'] }}</code>
                        </div>
                    @endforeach
                </x-ui.card.content>
            </x-ui.card>
        </div>
    </section>
</x-playground.layout>
