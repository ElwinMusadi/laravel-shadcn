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

        <section class="flex flex-col gap-4" aria-labelledby="forms-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="forms-heading">Forms</x-ui.heading>
                <x-ui.heading variant="description">Kontrol native yang mempertahankan atribut HTML, Livewire, dan Alpine.</x-ui.heading>
            </div>

            <x-ui.card>
                <x-ui.card.header>
                    <x-ui.card.title>Profile form</x-ui.card.title>
                    <x-ui.card.description>Contoh field, validasi, pilihan, dan kontrol boolean.</x-ui.card.description>
                </x-ui.card.header>
                <x-ui.card.content>
                    <form class="flex flex-col gap-6" action="#" method="POST">
                        <x-ui.field-group>
                            <x-ui.field>
                                <x-ui.label for="showcase-name" required>Name</x-ui.label>
                                <x-ui.input id="showcase-name" name="name" autocomplete="name" placeholder="Your name" required />
                                <x-ui.field.description>Nama ini akan terlihat pada profil Anda.</x-ui.field.description>
                            </x-ui.field>

                            <x-ui.field invalid>
                                <x-ui.label for="showcase-email" required>Email</x-ui.label>
                                <x-ui.input id="showcase-email" name="email" type="email" value="invalid-email" invalid />
                                <x-ui.field.error>This email address is invalid.</x-ui.field.error>
                            </x-ui.field>

                            <x-ui.field>
                                <x-ui.label for="showcase-bio">Bio</x-ui.label>
                                <x-ui.textarea id="showcase-bio" name="bio" maxlength="500" placeholder="Tell us about yourself."></x-ui.textarea>
                            </x-ui.field>

                            <x-ui.field>
                                <x-ui.label for="showcase-role">Role</x-ui.label>
                                <x-ui.select id="showcase-role" name="role" placeholder="Select a role" required>
                                    <option value="member">Member</option>
                                    <option value="admin">Administrator</option>
                                </x-ui.select>
                            </x-ui.field>
                        </x-ui.field-group>

                        <x-ui.radio-group label="Density" description="Pilih tingkat kerapatan tampilan yang nyaman.">
                            <x-ui.radio-group.option name="density" value="comfortable" checked>Comfortable</x-ui.radio-group.option>
                            <x-ui.radio-group.option name="density" value="compact" description="Lebih banyak konten dalam ruang yang sama.">Compact</x-ui.radio-group.option>
                            <x-ui.radio-group.option name="density" value="disabled" disabled>Unavailable</x-ui.radio-group.option>
                        </x-ui.radio-group>

                        <x-ui.field-group>
                            <x-ui.field orientation="horizontal">
                                <x-ui.checkbox id="showcase-terms" name="terms" required />
                                <div class="flex flex-col gap-1">
                                    <x-ui.label for="showcase-terms">Accept terms and conditions</x-ui.label>
                                    <x-ui.field.description>Persetujuan diperlukan untuk melanjutkan.</x-ui.field.description>
                                </div>
                            </x-ui.field>

                            <x-ui.field orientation="horizontal" class="items-center justify-between">
                                <div class="flex flex-col gap-1">
                                    <x-ui.label for="showcase-notifications">Enable notifications</x-ui.label>
                                    <x-ui.field.description>Anda dapat mengubahnya kapan saja.</x-ui.field.description>
                                </div>
                                <x-ui.switch id="showcase-notifications" name="notifications" checked />
                            </x-ui.field>
                        </x-ui.field-group>

                        <x-ui.button type="submit" class="self-start">Save changes</x-ui.button>
                    </form>
                </x-ui.card.content>
            </x-ui.card>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="data-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="data-heading">Data</x-ui.heading>
                <x-ui.heading variant="description">Struktur tabel dan pagination hanya menangani presentasi, bukan query atau state data.</x-ui.heading>
            </div>

            <x-ui.card>
                <x-ui.card.header>
                    <x-ui.card.title>Recent invoices</x-ui.card.title>
                    <x-ui.card.description>Surface tabel bertanggung jawab atas overflow horizontal pada layar kecil.</x-ui.card.description>
                </x-ui.card.header>
                <x-ui.card.content>
                    <x-ui.table>
                        <x-ui.table.caption>A list of recent invoices.</x-ui.table.caption>
                        <x-ui.table.header>
                            <x-ui.table.row>
                                <x-ui.table.head>Invoice</x-ui.table.head>
                                <x-ui.table.head>Status</x-ui.table.head>
                                <x-ui.table.head class="text-right">Amount</x-ui.table.head>
                            </x-ui.table.row>
                        </x-ui.table.header>
                        <x-ui.table.body>
                            <x-ui.table.row>
                                <x-ui.table.cell>INV-001</x-ui.table.cell>
                                <x-ui.table.cell><x-ui.badge variant="secondary">Paid</x-ui.badge></x-ui.table.cell>
                                <x-ui.table.cell class="text-right">$250.00</x-ui.table.cell>
                            </x-ui.table.row>
                            <x-ui.table.row>
                                <x-ui.table.cell>INV-002</x-ui.table.cell>
                                <x-ui.table.cell><x-ui.badge variant="outline">Pending</x-ui.badge></x-ui.table.cell>
                                <x-ui.table.cell class="text-right">$150.00</x-ui.table.cell>
                            </x-ui.table.row>
                        </x-ui.table.body>
                    </x-ui.table>
                </x-ui.card.content>
                <x-ui.card.footer>
                    <x-ui.pagination label="Invoice pages">
                        <x-ui.pagination.item><x-ui.pagination.previous disabled /></x-ui.pagination.item>
                        <x-ui.pagination.item><x-ui.pagination.link href="#page-1" active>1</x-ui.pagination.link></x-ui.pagination.item>
                        <x-ui.pagination.item><x-ui.pagination.link href="#page-2">2</x-ui.pagination.link></x-ui.pagination.item>
                        <x-ui.pagination.item><x-ui.pagination.ellipsis /></x-ui.pagination.item>
                        <x-ui.pagination.item><x-ui.pagination.next href="#page-2" /></x-ui.pagination.item>
                    </x-ui.pagination>
                </x-ui.card.footer>
            </x-ui.card>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="navigation-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="navigation-heading">Navigation</x-ui.heading>
                <x-ui.heading variant="description">Navigasi komposabel tanpa asumsi terhadap route atau state aplikasi.</x-ui.heading>
            </div>

            <x-ui.breadcrumb>
                <x-ui.breadcrumb.item><x-ui.breadcrumb.link href="{{ route('dashboard') }}">Home</x-ui.breadcrumb.link></x-ui.breadcrumb.item>
                <x-ui.breadcrumb.separator />
                <x-ui.breadcrumb.item><x-ui.breadcrumb.link href="{{ route('ui.components') }}">Components</x-ui.breadcrumb.link></x-ui.breadcrumb.item>
                <x-ui.breadcrumb.separator />
                <x-ui.breadcrumb.item><x-ui.breadcrumb.page>Forms, Data &amp; Navigation</x-ui.breadcrumb.page></x-ui.breadcrumb.item>
            </x-ui.breadcrumb>

            <x-ui.tabs id="showcase-tabs" default="account" class="max-w-xl">
                <x-ui.tabs.list aria-label="Account settings">
                    <x-ui.tabs.trigger value="account">Account</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="security">Security</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="billing" disabled>Billing</x-ui.tabs.trigger>
                </x-ui.tabs.list>
                <x-ui.tabs.content value="account">
                    <x-ui.card>
                        <x-ui.card.header>
                            <x-ui.card.title>Account</x-ui.card.title>
                            <x-ui.card.description>Kelola informasi profil pada tab aktif.</x-ui.card.description>
                        </x-ui.card.header>
                    </x-ui.card>
                </x-ui.tabs.content>
                <x-ui.tabs.content value="security">
                    <x-ui.card>
                        <x-ui.card.header>
                            <x-ui.card.title>Security</x-ui.card.title>
                            <x-ui.card.description>Tinjau password dan sesi aktif Anda.</x-ui.card.description>
                        </x-ui.card.header>
                    </x-ui.card>
                </x-ui.tabs.content>
                <x-ui.tabs.content value="billing">
                    <x-ui.alert>
                        <x-ui.alert.title>Billing unavailable</x-ui.alert.title>
                        <x-ui.alert.description>Tab ini sengaja dinonaktifkan untuk contoh state disabled.</x-ui.alert.description>
                    </x-ui.alert>
                </x-ui.tabs.content>
            </x-ui.tabs>
        </section>
    </div>
</x-layouts::app>
