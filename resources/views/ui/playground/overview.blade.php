<x-playground.layout
    :title="__('UI Playground')"
    :description="__('Living design system Blade-native untuk komponen, blok, dan pola aplikasi yang benar-benar tersedia.')"
    current="overview"
>
    <section class="flex flex-col gap-4" aria-labelledby="playground-purpose-heading">
        <x-ui.heading id="playground-purpose-heading" variant="section">Living design system</x-ui.heading>
        <x-ui.heading variant="description">
            Playground ini memakai komponen produksi yang sama dengan aplikasi: Laravel, Livewire, Blade, Tailwind CSS, dan Alpine. Ini bukan UI framework terpisah.
        </x-ui.heading>

        <x-ui.alert>
            <x-slot:icon>
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10" /><path d="M12 16v-4m0-4h.01" /></svg>
            </x-slot:icon>
            <x-ui.alert.title>{{ __('Source of truth') }}</x-ui.alert.title>
            <x-ui.alert.description>{{ __('Dokumentasi API pada setiap halaman mengikuti Blade component aktual, bukan asumsi dari implementasi lain.') }}</x-ui.alert.description>
        </x-ui.alert>
    </section>

    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3" aria-label="{{ __('Playground categories') }}">
        @foreach ([
            ['route' => 'ui.playground.foundations', 'title' => __('Foundations'), 'description' => __('Semantic tokens, typography, radius, dan shadows.')],
            ['route' => 'ui.components', 'title' => __('Components'), 'description' => __('Primitive core untuk surface, feedback, dan action.')],
            ['route' => 'ui.playground.forms', 'title' => __('Forms'), 'description' => __('Kontrol HTML native, state, dan komposisi field.')],
            ['route' => 'ui.playground.data-display', 'title' => __('Data Display'), 'description' => __('Table dan Pagination dengan data statis.')],
            ['route' => 'ui.playground.navigation', 'title' => __('Navigation'), 'description' => __('Breadcrumb dan Tabs yang dapat diakses.')],
            ['route' => 'ui.playground.interaction', 'title' => __('Interaction'), 'description' => __('Primitive Alpine lokal untuk overlay dan command.')],
            ['route' => 'ui.playground.application', 'title' => __('Application'), 'description' => __('Shell, sidebar, header, dan theme controller yang sedang digunakan.')],
            ['route' => 'ui.playground.blocks', 'title' => __('Blocks'), 'description' => __('Referensi Dashboard-01, sidebar aplikasi kanonis, Login-04, dan Signup-04.')],
            ['route' => 'ui.playground.authentication', 'title' => __('Authentication'), 'description' => __('Password field dan tautan aman ke flow Fortify aktual.')],
        ] as $category)
            <x-ui.card>
                <x-ui.card.header>
                    <x-ui.card.title>{{ $category['title'] }}</x-ui.card.title>
                    <x-ui.card.description>{{ $category['description'] }}</x-ui.card.description>
                </x-ui.card.header>
                <x-ui.card.footer>
                    <x-ui.button variant="outline" size="sm" onclick="window.location.href='{{ route($category['route']) }}'">{{ __('Open section') }}</x-ui.button>
                </x-ui.card.footer>
            </x-ui.card>
        @endforeach
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="playground-principles-heading">
        <x-ui.heading id="playground-principles-heading" variant="section">{{ __('Prinsip penggunaan') }}</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="grid gap-4 pt-6 md:grid-cols-3">
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-foreground">{{ __('Komposisi nyata') }}</p>
                    <p class="text-sm leading-6 text-muted-foreground">{{ __('Preview selalu merender x-ui.*, x-app.*, x-auth.*, atau blok yang ada.') }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-foreground">{{ __('Tanpa business logic') }}</p>
                    <p class="text-sm leading-6 text-muted-foreground">{{ __('Semua contoh memakai data lokal statis dan tidak menulis ke database.') }}</p>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-foreground">{{ __('Dua tema') }}</p>
                    <p class="text-sm leading-6 text-muted-foreground">{{ __('Gunakan theme toggle pada header untuk memeriksa Light dan Dark; tidak ada mode tema ketiga.') }}</p>
                </div>
            </x-ui.card.content>
        </x-ui.card>
    </section>
</x-playground.layout>
