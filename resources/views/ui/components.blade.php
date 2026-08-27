<x-layouts::app :title="__('UI Components')">
    <div class="mx-auto flex w-full max-w-6xl flex-col gap-10 px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-2">
            <x-ui.heading variant="page">UI Components</x-ui.heading>
            <x-ui.heading variant="description">Showcase internal untuk primitive Blade-native Phase 2 hingga Phase 4.</x-ui.heading>
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

        <section class="flex flex-col gap-4" aria-labelledby="dialog-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="dialog-heading">Dialog</x-ui.heading>
                <x-ui.heading variant="description">Modal memindahkan fokus ke konten, menutup dengan Escape atau backdrop, lalu mengembalikan fokus ke trigger.</x-ui.heading>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-ui.dialog id="showcase-basic-dialog">
                    <x-ui.dialog.trigger>Open dialog</x-ui.dialog.trigger>
                    <x-ui.dialog.content>
                        <x-ui.dialog.close class="absolute right-4 top-4" />
                        <x-ui.dialog.header>
                            <x-ui.dialog.title>Update profile</x-ui.dialog.title>
                            <x-ui.dialog.description>Perubahan hanya contoh tampilan dan tidak menyimpan data aplikasi.</x-ui.dialog.description>
                        </x-ui.dialog.header>
                        <x-ui.dialog.footer>
                            <x-ui.button variant="outline" @click="open = false">Cancel</x-ui.button>
                            <x-ui.button @click="open = false">Continue</x-ui.button>
                        </x-ui.dialog.footer>
                    </x-ui.dialog.content>
                </x-ui.dialog>

                <x-ui.dialog id="showcase-long-dialog">
                    <x-ui.dialog.trigger variant="outline">Long content</x-ui.dialog.trigger>
                    <x-ui.dialog.content>
                        <x-ui.dialog.close class="absolute right-4 top-4" />
                        <x-ui.dialog.header>
                            <x-ui.dialog.title>Scrollable dialog</x-ui.dialog.title>
                            <x-ui.dialog.description>Konten panjang tetap berada dalam viewport pada layar kecil.</x-ui.dialog.description>
                        </x-ui.dialog.header>
                        <div class="flex flex-col gap-3 px-6 pb-6 text-sm text-muted-foreground">
                            @for ($paragraph = 1; $paragraph <= 8; $paragraph++)
                                <p>Paragraf contoh {{ $paragraph }} menunjukkan area dialog yang dapat digulir tanpa memaksa viewport ikut melampaui batas.</p>
                            @endfor
                        </div>
                    </x-ui.dialog.content>
                </x-ui.dialog>

                <x-ui.dialog id="showcase-destructive-dialog">
                    <x-ui.dialog.trigger variant="destructive">Delete item</x-ui.dialog.trigger>
                    <x-ui.dialog.content>
                        <x-ui.dialog.close class="absolute right-4 top-4" />
                        <x-ui.dialog.header>
                            <x-ui.dialog.title>Delete this item?</x-ui.dialog.title>
                            <x-ui.dialog.description>Contoh aksi destructive; aplikasi pemakai menentukan konsekuensi dan logika aksinya sendiri.</x-ui.dialog.description>
                        </x-ui.dialog.header>
                        <x-ui.dialog.footer>
                            <x-ui.button variant="outline" @click="open = false">Cancel</x-ui.button>
                            <x-ui.button variant="destructive" @click="open = false">Delete</x-ui.button>
                        </x-ui.dialog.footer>
                    </x-ui.dialog.content>
                </x-ui.dialog>
            </div>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="sheet-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="sheet-heading">Sheet</x-ui.heading>
                <x-ui.heading variant="description">Panel arah independen dari sidebar aplikasi dan tetap lebar penuh pada layar mobile.</x-ui.heading>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-ui.sheet id="showcase-left-sheet">
                    <x-ui.sheet.trigger variant="outline">Open left sheet</x-ui.sheet.trigger>
                    <x-ui.sheet.content side="left">
                        <x-ui.sheet.close class="absolute right-4 top-4" />
                        <x-ui.sheet.header>
                            <x-ui.sheet.title>Left sheet</x-ui.sheet.title>
                            <x-ui.sheet.description>Panel dari sisi kiri untuk konten pelengkap.</x-ui.sheet.description>
                        </x-ui.sheet.header>
                    </x-ui.sheet.content>
                </x-ui.sheet>

                <x-ui.sheet id="showcase-right-sheet">
                    <x-ui.sheet.trigger>Open right sheet</x-ui.sheet.trigger>
                    <x-ui.sheet.content side="right">
                        <x-ui.sheet.close class="absolute right-4 top-4" />
                        <x-ui.sheet.header>
                            <x-ui.sheet.title>Right sheet</x-ui.sheet.title>
                            <x-ui.sheet.description>Contoh panel sisi kanan dengan backdrop dan tombol close.</x-ui.sheet.description>
                        </x-ui.sheet.header>
                    </x-ui.sheet.content>
                </x-ui.sheet>

                <x-ui.sheet id="showcase-mobile-sheet">
                    <x-ui.sheet.trigger variant="secondary">Mobile usage</x-ui.sheet.trigger>
                    <x-ui.sheet.content side="bottom">
                        <x-ui.sheet.close class="absolute right-4 top-4" />
                        <x-ui.sheet.header>
                            <x-ui.sheet.title>Mobile sheet</x-ui.sheet.title>
                            <x-ui.sheet.description>Varian bottom mengisi lebar layar dan mempertahankan tinggi aman viewport.</x-ui.sheet.description>
                        </x-ui.sheet.header>
                    </x-ui.sheet.content>
                </x-ui.sheet>
            </div>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="dropdown-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="dropdown-heading">Dropdown Menu</x-ui.heading>
                <x-ui.heading variant="description">Item tombol dan link tetap menggunakan elemen native; panah, Home, End, dan Escape didukung saat menu fokus.</x-ui.heading>
            </div>

            <x-ui.dropdown id="showcase-dropdown">
                <x-ui.dropdown.trigger>Open menu</x-ui.dropdown.trigger>
                <x-ui.dropdown.content>
                    <x-ui.dropdown.group>
                        <x-ui.dropdown.label>Account</x-ui.dropdown.label>
                        <x-ui.dropdown.item href="#profile">Profile</x-ui.dropdown.item>
                        <x-ui.dropdown.item>Billing</x-ui.dropdown.item>
                    </x-ui.dropdown.group>
                    <x-ui.dropdown.separator />
                    <x-ui.dropdown.group>
                        <x-ui.dropdown.item disabled>Team unavailable</x-ui.dropdown.item>
                        <x-ui.dropdown.item>Settings</x-ui.dropdown.item>
                    </x-ui.dropdown.group>
                </x-ui.dropdown.content>
            </x-ui.dropdown>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="popover-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="popover-heading">Popover &amp; Tooltip</x-ui.heading>
                <x-ui.heading variant="description">Popover memakai anchor sederhana yang dapat disejajarkan; tooltip menyediakan deskripsi untuk trigger icon.</x-ui.heading>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-ui.popover id="showcase-popover">
                    <x-ui.popover.trigger variant="outline">Open popover</x-ui.popover.trigger>
                    <x-ui.popover.content label="Popover example">
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-medium">Popover content</p>
                            <p class="text-sm text-muted-foreground">Konten ter-anchored dengan penutupan melalui Escape atau klik di luar.</p>
                        </div>
                    </x-ui.popover.content>
                </x-ui.popover>

                <x-ui.tooltip id="showcase-tooltip">
                    <x-ui.tooltip.trigger aria-label="Informasi komponen">i</x-ui.tooltip.trigger>
                    <x-ui.tooltip.content>Informasi tambahan untuk tombol icon.</x-ui.tooltip.content>
                </x-ui.tooltip>

                <x-ui.tooltip id="showcase-disabled-tooltip">
                    <x-ui.tooltip.trigger disabled aria-label="Aksi tidak tersedia">?</x-ui.tooltip.trigger>
                    <x-ui.tooltip.content>Aksi ini sedang tidak tersedia.</x-ui.tooltip.content>
                </x-ui.tooltip>
            </div>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="collapsible-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="collapsible-heading">Collapsible</x-ui.heading>
                <x-ui.heading variant="description">State terbuka dan tertutup bersifat lokal, dengan hubungan `aria-expanded` dan `aria-controls` yang dibuat otomatis.</x-ui.heading>
            </div>

            <x-ui.collapsible id="showcase-collapsible" class="max-w-xl rounded-lg border border-border p-4">
                <x-ui.collapsible.trigger>Show details</x-ui.collapsible.trigger>
                <x-ui.collapsible.content>
                    <p class="text-sm text-muted-foreground">Konten ini secara default tertutup dan dapat dibuka dengan keyboard atau pointer.</p>
                </x-ui.collapsible.content>
            </x-ui.collapsible>

            <x-ui.collapsible id="showcase-open-collapsible" default-open class="max-w-xl rounded-lg border border-border p-4">
                <x-ui.collapsible.trigger>Hide details</x-ui.collapsible.trigger>
                <x-ui.collapsible.content>
                    <p class="text-sm text-muted-foreground">Contoh kedua dimulai dalam state terbuka.</p>
                </x-ui.collapsible.content>
            </x-ui.collapsible>
        </section>

        <section class="flex flex-col gap-4" aria-labelledby="command-heading">
            <div class="flex flex-col gap-2">
                <x-ui.heading id="command-heading">Command</x-ui.heading>
                <x-ui.heading variant="description">Pencarian string sederhana dengan navigasi panah dan pemilihan keyboard; aksi tetap ditentukan oleh pemakai komponen.</x-ui.heading>
            </div>

            <x-ui.command id="showcase-command" class="max-w-xl overflow-hidden rounded-lg border border-border bg-popover text-popover-foreground shadow-sm">
                <div class="border-b border-border p-2">
                    <x-ui.command.input placeholder="Search commands..." />
                </div>
                <x-ui.command.empty>No command found.</x-ui.command.empty>
                <x-ui.command.list>
                    <x-ui.command.group heading="Suggestions">
                        <x-ui.command.item value="Calendar" keywords="schedule date">Calendar</x-ui.command.item>
                        <x-ui.command.item value="Search emoji" keywords="icons symbols">Search emoji</x-ui.command.item>
                    </x-ui.command.group>
                    <x-ui.command.group heading="Settings">
                        <x-ui.command.item value="Profile" href="#profile">Profile</x-ui.command.item>
                        <x-ui.command.item value="Appearance" disabled>Appearance unavailable</x-ui.command.item>
                    </x-ui.command.group>
                </x-ui.command.list>
            </x-ui.command>
        </section>
    </div>
</x-layouts::app>
