# Theming

## Token Amber

<code>resources/css/theme.css</code> adalah sumber kebenaran tema. Nilai raw CSS variable didefinisikan untuk <code>:root</code> (Light) dan <code>.dark</code> (Dark), lalu diekspos ke Tailwind melalui <code>@theme inline</code>.

Token mencakup:

- Surface dan teks: <code>background</code>, <code>foreground</code>, <code>card</code>, <code>popover</code>.
- Aksi dan state: <code>primary</code>, <code>secondary</code>, <code>muted</code>, <code>accent</code>, <code>destructive</code>, <code>border</code>, <code>input</code>, <code>ring</code>.
- Visual data: <code>chart-1</code> sampai <code>chart-5</code>.
- Sidebar: <code>sidebar</code>, <code>sidebar-foreground</code>, <code>sidebar-primary</code>, <code>sidebar-accent</code>, <code>sidebar-border</code>, dan <code>sidebar-ring</code>.
- Typography: sans, serif, mono.
- Radius dan shadow: <code>radius-sm</code> sampai <code>radius-xl</code> serta scale shadow.

Komponen reusable harus memakai utilitas semantik, misalnya:

~~~blade
<x-ui.card class="border-border bg-card text-card-foreground">
    <x-ui.button class="bg-primary text-primary-foreground">Save</x-ui.button>
</x-ui.card>
~~~

Hindari class palette mentah di primitive reusable. Ubah token, bukan warna per komponen.

## Light dan Dark

Light adalah default. Hanya ada dua nilai yang didukung:

~~~text
light
dark
~~~

Tidak ada mode System, Auto, OS preference, atau <code>prefers-color-scheme</code>. Class <code>dark</code> pada elemen <code>html</code> mengaktifkan token Dark. <code>resources/css/app.css</code> mendefinisikan custom variant Dark untuk Tailwind.

## Runtime tema

<code>x-app.theme-controller</code> dirender sinkron di head sebelum font dan Vite. Ia membaca <code>localStorage.theme</code>:

| Nilai storage | Hasil |
| --- | --- |
| <code>dark</code> | Menambahkan <code>dark</code> pada <code>html</code>. |
| <code>light</code>, kosong, tidak tersedia, atau invalid | Menghapus <code>dark</code>; Light aktif. |

Toggle hanya berubah antara Light dan Dark, menyimpan nilai eksplisit ke <code>localStorage.theme</code>, lalu memancarkan event <code>theme-changed</code>. Listener <code>livewire:navigating</code> menjalankan ulang penerapan root sebelum swap halaman, sehingga pilihan bertahan sepanjang navigasi Livewire.

Tidak ada cookie, session, database, state theme per-komponen, maupun state server untuk tema.

## Mengubah tema

1. Ubah semantic variable di <code>resources/css/theme.css</code>.
2. Pertahankan nama token yang telah menjadi API.
3. Perbarui Light dan Dark bila perubahan berlaku untuk keduanya.
4. Periksa setiap surface di UI Playground dalam Light dan Dark.
5. Jalankan Browser test tema serta build.
6. Jangan menutup masalah tema dengan class warna hard-coded pada komponen.

## Font

Vite mengirim font melalui plugin <code>laravel-vite-plugin/fonts</code> dan provider Bunny:

| Font | Weight yang dikonfigurasi |
| --- | --- |
| Inter | 400, 500, 600, 700 |
| Source Serif 4 | 400, 600, 700 |
| JetBrains Mono | 400, 500, 600 |

Konfigurasi berada di <code>vite.config.js</code>, dengan <code>optimizedFallbacks: false</code>. Gunakan <code>font-sans</code>, <code>font-serif</code>, atau <code>font-mono</code> yang telah dipetakan token; jangan menambah mekanisme pemuatan font baru tanpa kebutuhan dan review.

Lihat [Accessibility](accessibility.md) untuk pemeriksaan contrast dan [Testing](testing.md#tema) untuk validasi runtime.
