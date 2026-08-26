<x-layouts::app :title="__('Core UI Components')">
    <div class="mx-auto flex w-full max-w-6xl flex-col gap-10 px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-2">
            <x-ui.heading variant="page">Core UI Components</x-ui.heading>
            <x-ui.heading variant="description">Showcase internal untuk primitive Blade-native Phase 2.</x-ui.heading>
        </div>

        <section class="flex flex-col gap-4" aria-labelledby="buttons-heading">
            <x-ui.heading id="buttons-heading">Button</x-ui.heading>
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
            </div>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="card-heading">
            <x-ui.heading id="card-heading">Card</x-ui.heading>
            <x-ui.card class="max-w-xl">
                <x-ui.card.header>
                    <x-ui.card.title>Judul Card</x-ui.card.title>
                    <x-ui.card.description>Komposisi header, content, dan footer yang dapat digunakan ulang.</x-ui.card.description>
                </x-ui.card.header>
                <x-ui.card.content>
                    <p class="text-sm text-muted-foreground">Konten utama card menggunakan token semantik Phase 1.</p>
                </x-ui.card.content>
                <x-ui.card.footer>
                    <x-ui.button size="sm">Aksi</x-ui.button>
                </x-ui.card.footer>
            </x-ui.card>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="feedback-heading">
            <x-ui.heading id="feedback-heading">Badge, Alert, dan Separator</x-ui.heading>
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.badge>Default</x-ui.badge>
                <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                <x-ui.badge variant="destructive">Destructive</x-ui.badge>
                <x-ui.badge variant="outline">Outline</x-ui.badge>
            </div>
            <x-ui.separator />
            <div class="flex h-5 items-center gap-3 text-sm text-muted-foreground">
                <span>Dokumen</span>
                <x-ui.separator orientation="vertical" />
                <span>Komponen</span>
                <x-ui.separator orientation="vertical" />
                <span>Referensi</span>
            </div>
            <div class="grid gap-3 lg:grid-cols-2">
                <x-ui.alert>
                    <x-slot:icon>
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10" /><path d="M12 16v-4m0-4h.01" /></svg>
                    </x-slot:icon>
                    <x-ui.alert.title>Informasi komponen</x-ui.alert.title>
                    <x-ui.alert.description>Primitive ini tidak terikat pada session flash atau bisnis aplikasi.</x-ui.alert.description>
                </x-ui.alert>
                <x-ui.alert variant="destructive">
                    <x-ui.alert.title>Contoh destructive</x-ui.alert.title>
                    <x-ui.alert.description>Gunakan hanya untuk kondisi yang benar-benar perlu perhatian pengguna.</x-ui.alert.description>
                </x-ui.alert>
            </div>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="avatar-heading">
            <x-ui.heading id="avatar-heading">Avatar, Skeleton, dan Typography</x-ui.heading>
            <div class="flex items-center gap-4">
                <x-ui.avatar>
                    <x-ui.avatar.image src="https://github.com/shadcn.png" alt="Avatar contoh" />
                    <x-ui.avatar.fallback>SC</x-ui.avatar.fallback>
                </x-ui.avatar>
                <x-ui.avatar>
                    <x-ui.avatar.fallback>AB</x-ui.avatar.fallback>
                </x-ui.avatar>
                <div class="flex flex-1 flex-col gap-2">
                    <x-ui.skeleton class="h-4 w-48" />
                    <x-ui.skeleton class="h-4 w-32" />
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <x-ui.heading variant="section">Section heading</x-ui.heading>
                <x-ui.heading variant="subsection">Subsection heading</x-ui.heading>
                <x-ui.heading variant="description">Supporting text memakai `text-muted-foreground` dan elemen paragraf semantik.</x-ui.heading>
            </div>
        </section>
    </div>
</x-layouts::app>
