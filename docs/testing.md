# Testing

## Stack

Repository memakai Pest 4 dengan Laravel plugin. Test Feature dan Browser memakai <code>RefreshDatabase</code> melalui konfigurasi <code>tests/Pest.php</code>. Browser suite memakai <code>pestphp/pest-plugin-browser</code>, Playwright Chromium, dan factory user deterministik.

| Jenis | Lokasi | Nilai utama |
| --- | --- | --- |
| Unit | <code>tests/Unit/</code> | Logika kecil tanpa kebutuhan HTTP/browser. |
| Feature | <code>tests/Feature/</code> | Route, Blade rendering, Fortify, Livewire, token, dan kontrak aplikasi. |
| Browser | <code>tests/Browser/</code> | JavaScript, Alpine, keyboard/focus, responsive UI, navigasi, dan flow browser. |
| Runtime theme | <code>tests/ThemeControllerRuntime.test.mjs</code> | Kontrak JavaScript theme controller. |

## Menjalankan test

Jalankan Unit dan Feature terlebih dahulu:

~~~powershell
php artisan test --testsuite=Unit,Feature --compact
~~~

Jalankan Browser suite secara terpisah:

~~~powershell
vendor/bin/pest tests/Browser --compact
~~~

Jangan menggabungkan keduanya pada runner Windows ini. Teardown Playwright dapat membuat proses gabungan macet.

Untuk perbaikan terfokus, jalankan file atau filter paling sempit terlebih dahulu:

~~~powershell
vendor/bin/pest tests/Feature/UiComponentsTest.php --compact
vendor/bin/pest tests/Browser/InteractionBrowserTest.php --compact
~~~

## Cakupan Browser aktual

Browser test meliputi:

- Default Light, pilihan Dark, storage invalid, reload, dan navigasi Livewire.
- Shell aplikasi, collapse desktop, Sheet mobile, Dashboard-01, dan ukuran desktop/tablet/mobile.
- Route Playground, categories, dan proteksi guest.
- Dialog, Sheet, Dropdown, Popover, Tooltip, Collapsible, Command, Tabs, serta kontrol form native.
- Login, invalid login, email verification, Security settings, toast, passkey runtime, recovery code, dan dialog penghapusan akun.

Browser test representative memanggil <code>assertNoJavaScriptErrors()</code>. Sebagian flow juga memakai audit aksesibilitas level 1 melalui <code>assertNoAccessibilityIssues(1)</code>.

## Browser setup

Pastikan extension PHP <code>sockets</code> aktif pada CLI:

~~~powershell
php -m
~~~

Setelah <code>npm install</code>, pastikan Chromium Playwright tersedia. Bila browser belum tersedia di mesin lokal:

~~~powershell
npx playwright install chromium
~~~

Browser suite dijalankan dengan Chromium. Ia bukan pengganti pemeriksaan authenticator WebAuthn, QR code, atau teknologi bantu nyata.

## Tema

Test tema membuktikan Light sebagai default bahkan saat browser memilih dark, pilihan eksplisit disimpan pada <code>localStorage.theme</code>, nilai invalid tidak mengaktifkan Dark, serta pilihan bertahan pada <code>wire:navigate</code>.

## Urutan validasi

Untuk perubahan UI atau dokumentasi fase ini, jalankan:

~~~powershell
php artisan test --testsuite=Unit,Feature --compact
vendor/bin/pest tests/Browser --compact
npm run build
vendor/bin/pint --dirty --format agent
git diff --check
composer audit
npm audit --omit=dev
~~~

Jalankan build dan suite Unit/Feature secara berurutan, bukan bersamaan: build menulis Vite manifest yang dipakai rendering test.

## Windows runner

Pest Browser membutuhkan <code>ext-sockets</code>. Jika runner dihentikan paksa, Playwright kadang meninggalkan cache <code>vendor/pestphp/pest-plugin-browser/.temp/playwright-server.json</code>. Pastikan semua proses runner telah berhenti sebelum menghapus cache itu, lalu jalankan ulang Browser suite. Jangan menghapus file atau proses lain secara spekulatif.

Lihat [Accessibility](accessibility.md) untuk batas audit otomatis.
