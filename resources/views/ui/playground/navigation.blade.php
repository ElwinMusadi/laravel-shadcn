<x-playground.layout
    :title="__('Navigation')"
    :description="__('Primitive navigasi komposabel tanpa asumsi tentang route aplikasi atau state bisnis.')"
    current="navigation"
>
    <section class="flex flex-col gap-4" aria-labelledby="breadcrumb-heading">
        <x-ui.heading id="breadcrumb-heading" variant="section">Breadcrumb</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="flex flex-col gap-4 pt-6">
                <x-ui.breadcrumb label="Playground location">
                    <x-ui.breadcrumb.item><x-ui.breadcrumb.link href="{{ route('dashboard') }}" wire:navigate>Dashboard</x-ui.breadcrumb.link></x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item><x-ui.breadcrumb.link href="{{ route('ui.playground') }}" wire:navigate>UI Playground</x-ui.breadcrumb.link></x-ui.breadcrumb.item>
                    <x-ui.breadcrumb.separator />
                    <x-ui.breadcrumb.item><x-ui.breadcrumb.page>Navigation</x-ui.breadcrumb.page></x-ui.breadcrumb.item>
                </x-ui.breadcrumb>
                <p class="text-sm leading-6 text-muted-foreground">{{ __('Gunakan item, link, separator, dan page agar landmark serta aria-current terbentuk dari implementasi aktual.') }}</p>
            </x-ui.card.content>
        </x-ui.card>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="tabs-heading">
        <x-ui.heading id="tabs-heading" variant="section">Tabs</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="pt-6">
                <x-ui.tabs id="playground-tabs" default="account">
                    <x-ui.tabs.list aria-label="Account sections"><x-ui.tabs.trigger value="account">Account</x-ui.tabs.trigger><x-ui.tabs.trigger value="security">Security</x-ui.tabs.trigger><x-ui.tabs.trigger value="billing" disabled>Billing</x-ui.tabs.trigger></x-ui.tabs.list>
                    <x-ui.tabs.content value="account"><x-ui.alert><x-ui.alert.title>Account</x-ui.alert.title><x-ui.alert.description>State aktif dikelola lokal dengan Alpine dan keyboard arrow, Home, serta End.</x-ui.alert.description></x-ui.alert></x-ui.tabs.content>
                    <x-ui.tabs.content value="security"><x-ui.alert><x-ui.alert.title>Security</x-ui.alert.title><x-ui.alert.description>Tab panel menggunakan relationship aria-controls dan aria-labelledby.</x-ui.alert.description></x-ui.alert></x-ui.tabs.content>
                    <x-ui.tabs.content value="billing"><x-ui.alert><x-ui.alert.title>Billing unavailable</x-ui.alert.title><x-ui.alert.description>Trigger disabled tidak dapat dipilih.</x-ui.alert.description></x-ui.alert></x-ui.tabs.content>
                </x-ui.tabs>
            </x-ui.card.content>
        </x-ui.card>
        <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
<x-ui.tabs id="settings-tabs" default="profile">
    <x-ui.tabs.list>…</x-ui.tabs.list>
    <x-ui.tabs.content value="profile">…</x-ui.tabs.content>
</x-ui.tabs>
@endverbatim</code></pre>
    </section>
</x-playground.layout>
