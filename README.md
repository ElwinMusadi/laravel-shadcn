# Laravel Shadcn UI Starter

Starter kit Laravel untuk membangun aplikasi web Blade-native dengan bahasa desain yang terinspirasi shadcn. Repository ini memakai Laravel, Livewire, Blade, Alpine.js, dan Tailwind CSS 4; bukan aplikasi React, Vue, ataupun Inertia.

## Ringkasan

- Primitive UI generik di <code>resources/views/components/ui/</code>.
- Komposisi aplikasi, shell, sidebar, navigasi, tema, dan toast di <code>resources/views/components/app/</code>.
- Blok halaman reusable, termasuk Dashboard-01, berada di <code>resources/views/blocks/</code>.
- Dashboard-01 dan sidebar Dashboard-01 adalah komposisi kanonis aplikasi; Sidebar-07 bukan lagi shell utama.
- Tema Amber memakai token semantik, dengan Light sebagai default dan Dark sebagai pilihan eksplisit.
- Inter adalah font UI default; ikon aplikasi memakai subset Blade-native yang kompatibel dengan Lucide.
- Fortify tetap memiliki kontrak autentikasi; Blade, Livewire, dan Alpine menangani presentasi.
- UI Playground terlindungi di <code>/ui</code> merender komponen produksi sebagai Living Design System.
- Pest, Pest Browser, dan Playwright Chromium menyediakan validasi feature serta browser.

## Teknologi

| Lapisan | Implementasi |
| --- | --- |
| Framework | Laravel 13 |
| UI server-rendered | Blade dan Livewire 4 |
| Interaksi lokal | Alpine.js yang disediakan Livewire |
| Styling | Tailwind CSS 4 dan token semantik Amber |
| Autentikasi | Laravel Fortify dan <code>@laravel/passkeys</code> |
| Test | Pest 4, Pest Browser, Playwright Chromium |

## Mulai cepat

Ikuti [Getting Started](docs/getting-started.md) untuk kebutuhan, instalasi, database SQLite default, server pengembangan, build, dan test.

~~~powershell
composer install
npm install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
composer run dev
~~~

Untuk mengompilasi asset produksi, jalankan <code>npm run build</code>.

## Struktur proyek

~~~text
app/                         Logika Laravel, provider, model, dan action
resources/css/               Entry Tailwind dan token tema
resources/js/                Entry JavaScript dan runtime passkey
resources/views/components/  UI primitive, komponen aplikasi, dan auth
resources/views/blocks/      Komposisi UI reusable tingkat halaman
resources/views/pages/       Halaman auth dan Livewire
resources/views/ui/          Halaman UI Playground
routes/                      Route web dan settings
tests/                       Unit, Feature, Browser, dan runtime theme test
docs/                        Handbook developer
~~~

## Cara memakai starter kit

Mulailah dengan branding, navigasi, route, halaman domain, dan model aplikasi Anda. Pertahankan token semantik serta API primitive, lalu bangun kebutuhan khusus sebagai komponen aplikasi, blok, atau halaman sesuai [Starter Kit Workflow](docs/starter-kit-workflow.md). Gunakan [UI Playground](docs/layouts-and-pages.md#ui-playground) untuk memeriksa hasil secara manual.

## Panduan dokumentasi

- [Getting Started](docs/getting-started.md) — instalasi dan perintah pengembangan.
- [Architecture](docs/architecture.md) — batas tanggung jawab aplikasi.
- [Components](docs/components.md) — primitive UI, aplikasi, dan auth.
- [Forms](docs/forms.md) — kontrol form, validasi, dan binding.
- [Interactions](docs/interactions.md) — overlay dan interaksi Alpine.
- [Blocks](docs/blocks.md) — Dashboard-01 dan sidebar aplikasi kanonis.
- [Theming](docs/theming.md) — token Amber dan tema Light/Dark.
- [Layouts & Pages](docs/layouts-and-pages.md) — shell, halaman, dan Playground.
- [Livewire & Alpine](docs/livewire-and-alpine.md) — batas state server dan klien.
- [Authentication](docs/authentication.md) — integrasi Fortify dan passkey.
- [Testing](docs/testing.md) — Unit, Feature, Browser, dan build check.
- [Accessibility](docs/accessibility.md) — ekspektasi aksesibilitas dan QA manual.
- [AI Development](docs/ai-development.md) — cara kerja agen AI di repository ini.
- [Starter Kit Workflow](docs/starter-kit-workflow.md) — adaptasi ke proyek baru.
- [Troubleshooting](docs/troubleshooting.md) — masalah lokal yang umum.
- [Contributing](docs/contributing.md) — kontribusi yang aman dan konsisten.

## Panduan untuk agen AI

Sebelum mengubah apa pun, periksa <code>AGENTS.md</code>, <code>PROJECT_STATUS.md</code>, aturan di <code>.ai/rules/</code>, source aktual, serta test terkait. Repository ini adalah sumber kebenaran; referensi shadcn hanya dipakai untuk konsep dan bahasa visual. Detailnya ada pada [AI Development](docs/ai-development.md).
