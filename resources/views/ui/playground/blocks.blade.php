<x-playground.layout
    :title="__('Blocks')"
    :description="__('Referensi komposisi halaman aktual tanpa menyalin ulang implementasi blok.')"
    current="blocks"
>
    <section class="flex flex-col gap-4" aria-labelledby="dashboard-block-heading">
        <div class="flex flex-col gap-1">
            <x-ui.heading id="dashboard-block-heading" variant="section">Dashboard-01</x-ui.heading>
            <x-ui.heading variant="description">{{ __('Blok ini dirender langsung dari resources/views/blocks/dashboard/dashboard-01.blade.php dengan data demo lokalnya sendiri.') }}</x-ui.heading>
        </div>
        @include('blocks.dashboard.dashboard-01')
    </section>

    <section class="grid gap-4 lg:grid-cols-3" aria-labelledby="block-reference-heading">
        <x-ui.heading id="block-reference-heading" variant="section" class="lg:col-span-3">{{ __('Block references') }}</x-ui.heading>
        <x-ui.card>
            <x-ui.card.header><x-ui.card.title>Sidebar aplikasi Dashboard-01</x-ui.card.title><x-ui.card.description>Sidebar Dashboard-01 adalah region aplikasi kanonis, bukan blok halaman mandiri.</x-ui.card.description></x-ui.card.header>
            <x-ui.card.content><p class="text-sm leading-6 text-muted-foreground">{{ __('Sidebar aktual sudah terlihat di samping halaman ini, termasuk desktop collapse, Sheet mobile, Workspace Switcher, navigation, dan User Menu. Ia sengaja tidak di-embed ulang agar tidak membuat shell bersarang.') }}</p></x-ui.card.content>
        </x-ui.card>
        <x-ui.card>
            <x-ui.card.header><x-ui.card.title>Login-04</x-ui.card.title><x-ui.card.description>Surface login memakai x-layouts::auth dan halaman Fortify aktual.</x-ui.card.description></x-ui.card.header>
            <x-ui.card.footer><x-ui.button variant="outline" size="sm" onclick="window.location.href='{{ route('login') }}'">{{ __('Open login') }}</x-ui.button></x-ui.card.footer>
        </x-ui.card>
        <x-ui.card>
            <x-ui.card.header><x-ui.card.title>Signup-04</x-ui.card.title><x-ui.card.description>Surface registration memakai shell auth yang sama dan route Fortify aktual.</x-ui.card.description></x-ui.card.header>
            <x-ui.card.footer><x-ui.button variant="outline" size="sm" onclick="window.location.href='{{ route('register') }}'">{{ __('Open registration') }}</x-ui.button></x-ui.card.footer>
        </x-ui.card>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="block-api-heading">
        <x-ui.heading id="block-api-heading" variant="section">{{ __('Composition notes') }}</x-ui.heading>
        <x-ui.alert>
            <x-ui.alert.title>{{ __('No duplicate implementation') }}</x-ui.alert.title>
            <x-ui.alert.description>{{ __('Dashboard-01 dirender sebagai blok nyata. Sidebar aplikasi Dashboard-01, Login-04, dan Signup-04 direferensikan melalui instans atau route produksi karena masing-masing telah memiliki shell halaman sendiri.') }}</x-ui.alert.description>
        </x-ui.alert>
    </section>
</x-playground.layout>
