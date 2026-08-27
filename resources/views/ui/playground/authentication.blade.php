<x-playground.layout
    :title="__('Authentication')"
    :description="__('Referensi visual dan API untuk komponen auth tanpa menjalankan operasi autentikasi dari Playground.')"
    current="authentication"
>
    <section class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_minmax(0,0.8fr)]" aria-labelledby="password-field-heading">
        <div class="flex flex-col gap-4">
            <x-ui.heading id="password-field-heading" variant="section">Password Field</x-ui.heading>
            <x-ui.card>
                <x-ui.card.content class="pt-6">
                    <x-auth.password-field
                        id="playground-password"
                        label="Password"
                        autocomplete="current-password"
                        error="Contoh error statis untuk menunjukkan hubungan ARIA."
                        invalid
                    />
                </x-ui.card.content>
            </x-ui.card>
        </div>
        <div class="flex flex-col gap-4">
            <x-ui.heading variant="section">{{ __('API reference') }}</x-ui.heading>
            <x-ui.card><x-ui.card.header><x-ui.card.title class="font-mono text-base">x-auth.password-field</x-ui.card.title><x-ui.card.description>Field password native dengan toggle show/hide Alpine lokal, label, autocomplete, help link, dan error ARIA.</x-ui.card.description></x-ui.card.header><x-ui.card.content><p class="font-mono text-xs text-muted-foreground">id, name, label, autocomplete, required, autofocus, invalid, error, help-url, help-label</p></x-ui.card.content></x-ui.card>
        </div>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="auth-routes-heading">
        <div class="flex flex-col gap-1"><x-ui.heading id="auth-routes-heading" variant="section">{{ __('Authentication flows') }}</x-ui.heading><x-ui.heading variant="description">{{ __('Gunakan route aktual di bawah untuk menguji flow Fortify. Playground hanya memberi referensi; tidak mengirim form atau menampilkan data sensitif.') }}</x-ui.heading></div>
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ([
                ['label' => __('Login'), 'route' => 'login', 'description' => __('Login-04 dengan x-auth.password-field dan passkey verification.')],
                ['label' => __('Registration'), 'route' => 'register', 'description' => __('Signup-04 dengan field native dan validasi Fortify.')],
                ['label' => __('Password reset'), 'route' => 'password.request', 'description' => __('Request dan reset password pada halaman auth aktual.')],
                ['label' => __('Two-factor'), 'route' => 'two-factor.login', 'description' => __('Challenge code atau recovery code ketika fitur aktif.')],
            ] as $flow)
                <x-ui.card><x-ui.card.header><x-ui.card.title>{{ $flow['label'] }}</x-ui.card.title><x-ui.card.description>{{ $flow['description'] }}</x-ui.card.description></x-ui.card.header><x-ui.card.footer><x-ui.button variant="outline" size="sm" onclick="window.location.href='{{ route($flow['route']) }}'">{{ __('Open flow') }}</x-ui.button></x-ui.card.footer></x-ui.card>
            @endforeach
        </div>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="auth-boundary-heading">
        <x-ui.heading id="auth-boundary-heading" variant="section">{{ __('Security boundary') }}</x-ui.heading>
        <x-ui.alert>
            <x-ui.alert.title>{{ __('Reference only') }}</x-ui.alert.title>
            <x-ui.alert.description>{{ __('Playground tidak mengubah middleware, action, rate limiting, CSRF, passkey, two-factor, recovery code, atau kontrak Fortify mana pun.') }}</x-ui.alert.description>
        </x-ui.alert>
    </section>
</x-playground.layout>
