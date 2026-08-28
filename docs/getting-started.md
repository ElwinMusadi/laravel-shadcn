# Getting Started

## Kebutuhan

- PHP 8.3 atau lebih baru.
- Composer.
- Node.js dan npm.
- SQLite untuk konfigurasi default, atau database Laravel lain yang dikonfigurasi di <code>.env</code>.
- Untuk Browser test: extension PHP <code>sockets</code>, dependency npm yang sudah terpasang, dan Playwright Chromium.

Konfigurasi contoh menggunakan <code>DB_CONNECTION=sqlite</code>, session database, cache database, dan queue database. Siapkan database target sebelum menjalankan migrasi.

## Instalasi

~~~powershell
git clone <repository-url> <nama-proyek>
Set-Location <nama-proyek>
composer install
npm install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
~~~

Ganti nilai seperti <code>APP_NAME</code>, <code>APP_URL</code>, dan koneksi database di <code>.env</code> sebelum menggunakan aplikasi. Jika memakai SQLite baru, buat berkas database lalu arahkan <code>DB_DATABASE</code> kepadanya sesuai konfigurasi lokal Anda.

## Menjalankan aplikasi

<code>composer run dev</code> menjalankan perintah pengembangan Laravel. Gunakan mode ini untuk proses pengembangan terintegrasi.

~~~powershell
composer run dev
~~~

Alternatif yang tersedia:

~~~powershell
php artisan serve
npm run dev
~~~

<code>php artisan serve</code> melayani aplikasi dari PHP development server. <code>npm run dev</code> menjalankan Vite saja; gunakan saat server Laravel sudah berjalan terpisah. Untuk asset produksi:

~~~powershell
npm run build
~~~

## Perintah pengembangan

| Tujuan | Perintah |
| --- | --- |
| Menjalankan workflow dev Laravel | <code>composer run dev</code> |
| Menjalankan PHP development server | <code>php artisan serve</code> |
| Menjalankan Vite | <code>npm run dev</code> |
| Build asset produksi | <code>npm run build</code> |
| Unit dan Feature test | <code>php artisan test --testsuite=Unit,Feature --compact</code> |
| Browser test | <code>vendor/bin/pest tests/Browser --compact</code> |
| Memformat PHP yang berubah | <code>vendor/bin/pint --dirty --format agent</code> |
| Full quality script Composer | <code>composer test</code> |
| Static analysis | <code>composer types:check</code> |
| Audit package PHP | <code>composer audit</code> |
| Audit dependency npm produksi | <code>npm audit --omit=dev</code> |
| Cek whitespace diff | <code>git diff --check</code> |

Lihat [Testing](testing.md) untuk urutan validasi dan browser runner.

## Konvensi kerja awal

1. Jalankan <code>git status</code> sebelum bekerja.
2. Baca <code>AGENTS.md</code>, <code>PROJECT_STATUS.md</code>, dan aturan yang relevan di <code>.ai/rules/</code>.
3. Periksa komponen dan test yang sudah ada sebelum membuat API baru.
4. Gunakan token semantik dan komponen yang tersedia.
5. Validasi perubahan, lalu periksa <code>git diff --check</code>.

Setelah setup, lanjutkan ke [Architecture](architecture.md) dan [Starter Kit Workflow](starter-kit-workflow.md).
