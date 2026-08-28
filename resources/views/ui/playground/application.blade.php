<x-playground.layout
    :title="__('Application')"
    :description="__('Komponen aplikasi telah dirender oleh shell aktif yang membungkus Playground ini.')"
    current="application"
>
    <section class="flex flex-col gap-4" aria-labelledby="shell-heading">
        <x-ui.heading id="shell-heading" variant="section">Shell, Header, Sidebar, dan Theme Toggle</x-ui.heading>
        <x-ui.alert>
            <x-ui.alert.title>{{ __('Preview aktual sedang aktif') }}</x-ui.alert.title>
            <x-ui.alert.description>{{ __('Halaman ini berada di dalam x-app.shell. Sidebar desktop/mobile, Header, Brand, Workspace Switcher, Navigation, User Menu, dan Theme Toggle di atas adalah instans produksi yang sama—tidak dibuat ulang di dalam preview.') }}</x-ui.alert.description>
        </x-ui.alert>
        <x-ui.card>
            <x-ui.card.header><x-ui.card.title>Application composition</x-ui.card.title><x-ui.card.description>Gunakan shell sebagai layout route authenticated; jangan mengembed shell kembali dalam halaman atau blok.</x-ui.card.description></x-ui.card.header>
            <x-ui.card.content>
                <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
&lt;x-layouts::app
    :title="$title"
    :breadcrumbs="$breadcrumbs"
    :show-page-header="true"
&gt;
    …
&lt;/x-layouts::app&gt;
@endverbatim</code></pre>
            </x-ui.card.content>
        </x-ui.card>
    </section>

    <section class="grid gap-4 lg:grid-cols-2" aria-labelledby="application-api-heading">
        <x-ui.heading id="application-api-heading" variant="section" class="lg:col-span-2">{{ __('Component API reference') }}</x-ui.heading>
        @foreach ([
            ['x-app.shell', 'title, description, breadcrumbs, show-page-header, navigation, workspaces', 'Satu sumber data navigation dan workspace untuk desktop serta mobile.'],
            ['x-app.page-header', 'title, description, breadcrumbs, actions slot', 'Merender breadcrumb dan heading page yang dipakai setiap halaman Playground.'],
            ['x-app.navigation', 'groups, label, mobile', 'Mendukung route aktif, nested item, collapsible, dan wire:navigate.'],
            ['x-app.theme-toggle', 'attribute bag', 'Memakai theme controller root Light/Dark yang sama; tidak ada mode tema ketiga.'],
        ] as [$componentName, $api, $note])
            <x-ui.card><x-ui.card.header><x-ui.card.title class="font-mono text-base">{{ $componentName }}</x-ui.card.title><x-ui.card.description>{{ $note }}</x-ui.card.description></x-ui.card.header><x-ui.card.content><p class="font-mono text-xs text-muted-foreground">{{ $api }}</p></x-ui.card.content></x-ui.card>
        @endforeach
    </section>
</x-playground.layout>
