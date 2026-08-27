<x-playground.layout
    :title="__('Components')"
    :description="__('Primitive core untuk action, surface, feedback, identity, loading, dan struktur konten.')"
    current="components"
>
    <section class="flex flex-col gap-4" aria-labelledby="button-heading">
        <x-ui.heading id="button-heading" variant="section">Button</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="flex flex-col gap-5 pt-6">
                <div class="flex flex-wrap items-center gap-3">
                    <x-ui.button>Default</x-ui.button>
                    <x-ui.button variant="secondary">Secondary</x-ui.button>
                    <x-ui.button variant="destructive">Destructive</x-ui.button>
                    <x-ui.button variant="outline">Outline</x-ui.button>
                    <x-ui.button variant="ghost">Ghost</x-ui.button>
                    <x-ui.button variant="link">Link</x-ui.button>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <x-ui.button size="sm">Small</x-ui.button>
                    <x-ui.button>Default</x-ui.button>
                    <x-ui.button size="lg">Large</x-ui.button>
                    <x-ui.button size="icon" aria-label="Tambah item">+</x-ui.button>
                    <x-ui.button disabled>Disabled</x-ui.button>
                </div>
                <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
<x-ui.button variant="outline" size="sm">Batal</x-ui.button>
@endverbatim</code></pre>
            </x-ui.card.content>
        </x-ui.card>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="card-heading">
        <x-ui.heading id="card-heading" variant="section">Card</x-ui.heading>
        <div class="grid gap-4 xl:grid-cols-[minmax(0,1fr)_minmax(0,0.8fr)]">
            <x-ui.card>
                <x-ui.card.header>
                    <x-ui.card.title>Project settings</x-ui.card.title>
                    <x-ui.card.description>Header, title, description, content, dan footer dapat dikomposisikan secara independen.</x-ui.card.description>
                </x-ui.card.header>
                <x-ui.card.content><p class="text-sm leading-6 text-muted-foreground">Konten menggunakan surface card dan token teks yang sama seperti seluruh aplikasi.</p></x-ui.card.content>
                <x-ui.card.footer><x-ui.button size="sm">Save changes</x-ui.button><x-ui.button variant="outline" size="sm">Cancel</x-ui.button></x-ui.card.footer>
            </x-ui.card>
            <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
<x-ui.card>
    <x-ui.card.header>…</x-ui.card.header>
    <x-ui.card.content>…</x-ui.card.content>
    <x-ui.card.footer>…</x-ui.card.footer>
</x-ui.card>
@endverbatim</code></pre>
        </div>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="feedback-heading">
        <x-ui.heading id="feedback-heading" variant="section">Badge, Alert, dan Separator</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="flex flex-col gap-5 pt-6">
                <div class="flex flex-wrap gap-3"><x-ui.badge>Default</x-ui.badge><x-ui.badge variant="secondary">Secondary</x-ui.badge><x-ui.badge variant="destructive">Destructive</x-ui.badge><x-ui.badge variant="outline">Outline</x-ui.badge></div>
                <x-ui.separator />
                <div class="flex h-5 items-center gap-3 text-sm text-muted-foreground"><span>Overview</span><x-ui.separator orientation="vertical" /><span>Components</span><x-ui.separator orientation="vertical" :decorative="false" /><span>Reference</span></div>
                <div class="grid gap-3 lg:grid-cols-2">
                    <x-ui.alert><x-slot:icon><span class="font-semibold">i</span></x-slot:icon><x-ui.alert.title>Informasi</x-ui.alert.title><x-ui.alert.description>Alert menyediakan role alert serta slot icon opsional.</x-ui.alert.description></x-ui.alert>
                    <x-ui.alert variant="destructive"><x-ui.alert.title>Destructive</x-ui.alert.title><x-ui.alert.description>Gunakan untuk kondisi yang membutuhkan perhatian pengguna.</x-ui.alert.description></x-ui.alert>
                </div>
            </x-ui.card.content>
        </x-ui.card>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="identity-heading">
        <x-ui.heading id="identity-heading" variant="section">Avatar dan Skeleton</x-ui.heading>
        <x-ui.card>
            <x-ui.card.content class="flex flex-col gap-6 pt-6 sm:flex-row sm:items-center">
                <div class="flex items-center gap-3"><x-ui.avatar><x-ui.avatar.image src="/missing-avatar.png" alt="Avatar unavailable example" /><x-ui.avatar.fallback>LP</x-ui.avatar.fallback></x-ui.avatar><x-ui.avatar><x-ui.avatar.fallback>UI</x-ui.avatar.fallback></x-ui.avatar></div>
                <div class="flex flex-1 flex-col gap-3"><x-ui.skeleton class="h-4 w-full max-w-64" /><x-ui.skeleton class="h-4 w-3/4 max-w-48" /></div>
            </x-ui.card.content>
        </x-ui.card>
    </section>

    <section class="flex flex-col gap-3" aria-labelledby="heading-heading">
        <x-ui.heading id="heading-heading" variant="section">Heading / Typography helper</x-ui.heading>
        <x-ui.card><x-ui.card.content class="flex flex-col gap-3 pt-6"><x-ui.heading variant="section">Section heading</x-ui.heading><x-ui.heading variant="subsection">Subsection heading</x-ui.heading><x-ui.heading variant="description">Description menghasilkan elemen paragraf dengan token muted.</x-ui.heading></x-ui.card.content></x-ui.card>
    </section>
</x-playground.layout>
