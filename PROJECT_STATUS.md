# Project Status

## Current Phase

Phase 12 — Final Flux Migration & Cleanup

## Completed

- Phase 0
- Phase 1 — Amber Design System Foundation
- Phase 2 — Core UI Components
- Phase 3 — Forms, Data and Navigation Components
- Phase 4 — Advanced Interaction Components
- Phase 5 — Application Shell
- Phase 6 — Dashboard-01
- Phase 7 — Sidebar-07
- Phase 8 — Login-04 / Signup-04
- Phase 9 — Theme Controller / Appearance
- Phase 10 — UI Playground
- Phase 11 — Testing, Browser Validation & Accessibility
- Phase 12 — Final Flux Migration & Cleanup

## Current Architecture

- Laravel, Livewire, Blade, Tailwind CSS 4, dan Alpine.js.
- Token semantik Amber dari Phase 1 adalah sumber kebenaran visual.
- Shell aplikasi berada di `resources/views/components/app/`; primitive tetap berada di `resources/views/components/ui/`.
- Tidak ada runtime dependency Flux. Toast, Settings Security, passkey registration, recovery-code management, dan dialog konfirmasi memakai komponen Blade/Alpine milik proyek.
- Dashboard terlindungi tetap berada pada route `dashboard`, dengan komposisi spesifik di `resources/views/blocks/dashboard/` agar region navigasi shell dapat diganti pada Phase 7 tanpa membangun ulang konten dashboard.
- UI Playground kanonis berada pada route authenticated + verified `ui.playground` (`/ui`) dengan halaman kategori di bawah `/ui/*`. Seluruh surface memakai `x-layouts::app`, komponen produksi, token semantik, serta data statis lokal.

## Component Inventory

- Core: Button, Card, Badge, Separator, Alert, Avatar, Skeleton, dan Heading/Typography.
- Forms: Field, Field Group, Label, Input, Textarea, Select, Checkbox, Radio Group, Switch, Field Description, dan Field Error.
- Data: Table dan Pagination.
- Navigation: Breadcrumb dan Tabs.
- Advanced Interaction: Dialog, Sheet, Dropdown Menu, Popover, Tooltip, Collapsible, dan Command.
- Application Shell: Shell, Brand, Header, Sidebar, Workspace Switcher, Navigation, User Menu, dan Page Header.
- Dashboard-01: dashboard composition, section cards, chart SVG dengan kontrol Alpine lokal, dan data table demo dengan Dropdown actions.

## Phase 4 Architecture

- Primitive interaksi baru tetap Blade-native dan menggunakan state Alpine lokal hanya pada elemen yang memerlukan interaksi.
- Atribut pemanggil, termasuk `wire:*` dan `x-data`, diteruskan ke wrapper luar agar tidak berbenturan dengan state internal komponen.
- Dialog dan Sheet menyediakan backdrop, Escape, fokus awal, pengembalian fokus ke trigger, serta focus trap ringan berbasis DOM native.
- Dropdown Menu dan Popover menggunakan anchor CSS sederhana tanpa positioning engine eksternal; `Command` memakai pencocokan string client-side dan event DOM `command-close` untuk integrasi opsional dengan Dialog atau Sheet.
- Semua surface Phase 4 memakai token semantik Phase 1 dan tidak bergantung pada Flux.

## Phase 5 Architecture

- `x-app.shell` menyusun header, navigasi responsif, landmark `main`, page header opsional, dan batas runtime toast sementara.
- `x-app.navigation` memakai data route name, pola route aktif, serta `wire:navigate`; struktur tersebut siap menjadi region navigasi/sidebar pada fase berikutnya tanpa mengubah layout lagi.
- `x-app.user-menu` memakai primitive Dropdown, menampilkan identitas user, mengarah ke settings dengan route name, dan mempertahankan form logout `POST` dengan CSRF.
- `x-app.page-header` mengomposisikan judul, deskripsi, actions, dan Breadcrumb UI tanpa membuat UI component baru yang bergantung pada route.
- Header memakai Sheet UI untuk navigasi seluler, sementara navigasi desktop tetap server-rendered.

## Phase 6 Architecture

- Referensi resmi shadcn `dashboard-01` diterjemahkan ke Blade `dashboard-01`, `section-cards`, `chart-area`, dan `data-table`; bagian React/TSX, TanStack Table, Recharts, DnD, dan sidebar tidak dibawa.
- Chart memakai SVG responsif yang dihasilkan Blade, token `chart-1`, serta Alpine lokal hanya untuk pemilihan rentang waktu dan menampilkan series statis terkait.
- Semua metrik, series chart, dan baris table berupa demo data statis; Phase 6 tidak menambah query, model, atau analytics business-data.
- Section cards memakai `x-ui.card` dan `x-ui.badge`; table memakai `x-ui.table.*`; action rows memakai `x-ui.dropdown`; dashboard tetap berada di dalam shell, page header, dan breadcrumb Phase 5.
- Grid kartu beradaptasi dari satu menjadi dua lalu empat kolom, chart memakai lebar container, dan tabel dapat digulir horizontal pada layar sempit.
- Chart memiliki title, description, dan daftar nilai `sr-only`; controls, dropdown, landmark section, heading hierarchy, serta table memakai markup semantik dan fokus dari primitive yang ada.

## Phase 7 Architecture

- Referensi resmi shadcn `sidebar-07` diterjemahkan sebagai sidebar Blade-native dengan header, content yang dapat digulir, footer, grup navigasi, mode ikon, trigger, dan Sheet seluler. React/TSX, Radix, hook, context, dan paket sidebar tidak ditambahkan.
- `x-app.shell` adalah satu sumber data navigasi dan workspace. Data yang sama diteruskan ke `x-app.sidebar` desktop dan `x-app.sidebar` dalam `x-ui.sheet` seluler; data tidak diduplikasi menurut breakpoint.
- State Alpine tetap lokal di shell: `sidebarExpanded` untuk desktop `expanded` atau `collapsed`. State `open` Sheet tetap berada di `x-ui.sheet`, sehingga desktop collapse dan mobile drawer adalah state terpisah. State tidak dipersistenkan agar tidak menimbulkan flicker layout atau risiko pada navigasi Livewire.
- Lebar sidebar berada pada `--app-sidebar-expanded` dan `--app-sidebar-collapsed` di shell. Layout flex menyesuaikan main content melalui CSS tanpa perhitungan JavaScript.
- Sidebar desktop memakai token `sidebar-*`, label visual disembunyikan pada mode ikon dengan `aria-label` dan `title` tetap tersedia. Klik item bercabang ketika collapsed akan memperluas sidebar sebelum membuka submenu.
- Mobile memakai `x-ui.sheet` untuk dialog, Escape, close control, focus awal, focus trap ringan, dan pengembalian fokus. Sidebar mobile selalu menampilkan label lengkap serta footer user menu.
- `x-app.navigation` mendukung grup, route name, pola route aktif, submenu `x-ui.collapsible`, `aria-current`, `aria-expanded`, dan `wire:navigate`. `x-app.workspace-switcher` menerima data workspace demo melalui `x-ui.dropdown` tanpa database.
- `x-app.user-menu` tetap satu-satunya pemilik identitas, tautan Settings, form logout `POST`, dan CSRF; presentasinya dipindahkan ke footer sidebar. Header menjadi lokasi trigger sidebar dan shortcut `Ctrl/Cmd + B` tersedia di luar elemen editable.

## Phase 8 Architecture

- Referensi resmi shadcn `login-04` dan `signup-04` diterjemahkan ke Blade-native dengan satu shell `x-layouts::auth`. Shell menyusun card responsif, form content slot, brand aplikasi, dan panel visual desktop berbasis token semantik serta bentuk dekoratif lokal; tidak ada React, gambar eksternal, atau provider login palsu.
- `x-layouts::auth.card` dan `x-layouts::auth.split` kini mendelegasikan ke shell yang sama, sehingga tidak ada shell autentikasi paralel. Halaman mobile tetap satu kolom; panel visual muncul pada breakpoint desktop.
- Semua halaman Fortify yang tersedia memakai bahasa visual yang sama: Login, Registration, Password reset request, Password reset, Email verification, Password confirmation, Two-factor challenge, Recovery code flow, dan Passkey UI. Route, action, CSRF, redirect, limiter, request parameter, serta validasi Fortify tidak diubah.
- Login dan password confirmation mempertahankan `x-passkey-verify` dengan route dan integrasi `@laravel/passkeys` yang sama. UI passkey registration dan recovery code management tetap berada pada Settings sehingga sengaja tidak disentuh pada Phase 8.
- `x-auth.password-field` menyediakan input password native, autocomplete yang sesuai, toggle show/hide lokal Alpine, label terasosiasi, dan error ARIA. Semua formulir memakai primitive Phase 3 `x-ui.field`, `x-ui.field-group`, `x-ui.label`, `x-ui.input`, `x-ui.checkbox`, `x-ui.field.error`, dan `x-ui.button`.
- Two-factor challenge mempertahankan kontrak `code` atau `recovery_code`; input nonaktif saat mode lain aktif, OTP memakai `inputmode="numeric"`, `maxlength="6"`, dan `autocomplete="one-time-code"`. Tidak ada library OTP baru.
- Presentasi Flux telah dihapus dari halaman auth aktif, header/status auth, passkey verification, dan auth layouts. Auth layout kini memakai `@livewireScripts` untuk tetap mendukung Alpine/Livewire dan passkey flow. Flux pada Settings selain appearance, toast shell, dan komponen `passkey-registration`/recovery management tetap untuk fase migrasi masing-masing.
- Aksesibilitas mencakup label untuk semua control, `aria-invalid` dan `aria-describedby` pada error, `role="alert"` untuk error, `role="status"`/`aria-live` untuk status, fokus terlihat, tombol dengan tipe tepat, serta autocomplete password/email/OTP yang sesuai.

## Phase 9 Architecture

- Tema aplikasi hanya memiliki dua state: `light` dan `dark`. Saat `localStorage.theme` tidak tersedia, tidak ada, atau berisi nilai yang tidak didukung, aplikasi memilih Light dan tidak menulis ulang nilai invalid tersebut.
- `x-app.theme-controller` berjalan sinkron di `<head>` sebelum font dan Vite. Bootstrap kecil ini hanya membaca `localStorage.theme` lalu menambah atau menghapus `dark` pada elemen `<html>`; ia tidak memakai `prefers-color-scheme`, `matchMedia`, cookie, session, database, maupun request server.
- `x-app.theme-toggle` berada di header aplikasi dan memakai tooltip serta button UI existing. Tombol memiliki label dinamis, `aria-pressed`, status screen-reader, fokus terlihat, dan icon Moon/Sun native SVG tanpa dependency icon baru.
- Settings Appearance memakai `x-ui.radio-group` dengan pilihan Light dan Dark saja. Kontrol Settings dan header menggunakan factory Alpine yang sama; state tampilan mereka hanya merefleksikan `<html>.dark` dan sinkron melalui event DOM `theme-changed`.
- Landing page, shell aplikasi, dan auth layout tidak lagi memaksa class `dark`, sehingga seluruh route utama, halaman authentication, sidebar, dan Dashboard-01 mengikuti root yang sama. Listener Livewire tunggal menggunakan lifecycle `livewire:navigating` dan `onSwap` untuk menerapkan ulang root sebelum script halaman baru berjalan; listener tidak diduplikasi. Token Amber Phase 1, chart tokens, dan arsitektur semantic-token tidak diubah.
- Ownership appearance telah dipindahkan dari Flux. Inversi QR setup 2FA sekarang mengikuti class `dark` pada root melalui varian Tailwind. `@fluxScripts`, `@persist('toast')`, `flux:toast`, Settings security, passkey registration, dan recovery-code management tetap dipertahankan.

## Phase 10 Architecture

- `ui.playground` (`/ui`) adalah titik masuk kanonis UI Playground. Halaman kategori Foundations, Components, Forms, Data Display, Navigation, Interaction, Application, Blocks, dan Authentication memakai route named sendiri di bawah middleware `auth` dan `verified`; route lama `ui.components` berevolusi menjadi halaman Components pada `/ui/components`, sehingga tidak ada showcase paralel.
- `x-playground.layout` membungkus `x-layouts::app`, sehingga Playground mewarisi Shell, Header, Sidebar-07, Page Header, Theme Toggle, landmark, responsivitas, serta perilaku `wire:navigate` yang sama dengan aplikasi. Navigasi internal hanya memuat satu tautan UI Playground di sidebar aplikasi dan daftar kategori khusus pada konten Playground.
- Foundations menampilkan seluruh token semantic theme (termasuk chart dan sidebar), font configured, `radius-sm` hingga `radius-xl`, dan shadow scale aktual. Tidak ada raw color, font, radius, shadow, atau token baru; Light dan Dark berasal dari controller root yang sudah ada dan tidak memiliki mode ketiga.
- Semua preview merender `x-ui.*`, `x-app.*`, `x-auth.password-field`, atau `Dashboard-01` aktual. Forms, table, pagination, command, dan menu memakai data contoh deterministik di Blade tanpa query database, API, state server, atau business logic baru.
- Interactive demos memakai implementasi Alpine lokal yang ada untuk Dialog, Sheet empat sisi, Dropdown, Popover, Tooltip, Collapsible, dan Command. API notes dan contoh Blade singkat merujuk pada atribut yang benar-benar didukung setiap component.
- Blocks menampilkan `Dashboard-01` langsung. Sidebar-07 sudah merupakan shell yang mengelilingi halaman dan tidak di-embed berulang; Login-04 dan Signup-04 direferensikan melalui route Fortify dan shell auth aktual agar tidak membuat document/shell bersarang atau menjalankan operasi auth dari Playground.
- Accessibility Playground mencakup satu H1 dari Page Header, heading section berurutan, landmark navigation, link kategori dengan `aria-current`, preview button berlabel, table caption, serta komponen interaktif existing yang sudah menyediakan keyboard/focus semantics. Browser E2E tetap menjadi debt Phase 11.

## Phase 11 Architecture

- Browser integration memakai `pestphp/pest-plugin-browser` 4.3.1 dan Playwright Chromium. Test berada di `tests/Browser/`, memakai `RefreshDatabase`, factory user deterministik, serta viewport desktop, tablet, dan mobile.
- Cakupan Browser memverifikasi default Light, Dark eksplisit, reload/localStorage invalid, toggle, navigasi `wire:navigate`, sidebar desktop/mobile, Dashboard-01, kategori Playground, Dialog, Sheet, Dropdown, Popover, Tooltip, Collapsible, Command, Tabs, kontrol form native, guest route protection, login, invalid login, dan route email-verification Fortify.
- Validasi browser menemukan dan memperbaiki ekspresi Alpine dengan selector ber-quote yang tidak valid pada Dropdown dan Popover; navigasi keyboard menggunakan `Array.from(...)` agar aman pada ekspresi Blade/Alpine. Contoh kode Playground kini di-escape sehingga tidak lagi diinterpretasi sebagai elemen Alpine aktif.
- Semantik alternatif chart diperbaiki menjadi pasangan `dt`/`dd`; token `destructive` dan `sidebar-primary-foreground` disetel ulang untuk memenuhi audit contrast mode terang tanpa menambah token atau mengubah struktur visual.

## Flux Migration Boundary

- Dimigrasikan pada Phase 5: Flux sidebar, header, navbar, profile dropdown, menu shell, dan wrapper brand lama pada shell aplikasi.
- Dimigrasikan pada Phase 7: region navigasi header Phase 5 digantikan sidebar desktop dan Sheet mobile Blade-native. Flux tidak menangani sidebar, navigasi mobile, collapse, atau rendering navigasi.
- Dimigrasikan pada Phase 8: layout, halaman, form, header/status, serta passkey verification autentikasi. Halaman auth aktif tidak lagi memakai presentasi Flux.
- Dimigrasikan pada Phase 9: bootstrap dan controller appearance, toggle header, pilihan Appearance Settings, serta dependency QR setup 2FA terhadap state appearance Flux.
- Phase 12 mengganti sisa surface Settings (Profile, Security, 2FA, passkey, recovery code, dan hapus akun) dengan `x-ui.*`, Blade native, dan Alpine lokal tanpa mengubah action, route, validasi, atau kontrak Fortify.
- Toast project-owned berada pada `x-app.toast`: event Livewire `toast` dengan `variant` (`success`, `info`, `warning`, `error`) dan `text` diterima oleh live region persistent, dapat ditutup dengan keyboard, serta auto-dismiss setelah lima detik.
- `x-ui.dialog` sekarang menerima event buka lokal untuk dialog yang dipicu action Livewire dan memancarkan `dialog-closed`, sehingga reset state keamanan tetap dijalankan saat pengguna menutup overlay.
- `livewire/flux` beserta CSS, source path Tailwind, directive, view ikon/navlist yang tidak lagi dipakai, serta skill Boost terkait telah dihapus. `@laravel/passkeys`, Livewire, Fortify, Alpine, dan tema Light/Dark tetap dipertahankan.

## Latest Validation

- Phase 1: Pint, test suite (35 tests / 126 assertions), `npm run build`, `git diff --check`, dan audit token semantik lulus.
- Phase 2: `vendor/bin/pint --dirty --format agent`, test suite (45 tests / 191 assertions), `npm run build`, `git diff --check`, dan audit token/teknologi lulus.
- Phase 3: `vendor/bin/pint --dirty --format agent`, test suite (54 tests / 273 assertions), `npm run build`, `git diff --check`, serta audit token, dark mode, Livewire, Flux, responsivitas, dan teknologi terlarang lulus.
- Phase 4: `vendor/bin/pint --dirty --format agent`, full Pest suite (61 tests / 371 assertions), `npm run build`, dan `git diff --check` lulus. Audit token semantik, dark mode, Alpine lokal, Livewire attribute forwarding, responsivitas, kompatibilitas Flux, dan teknologi terlarang juga lulus.
- Phase 5: `vendor/bin/pint --dirty --format agent`, full Pest suite (65 tests / 402 assertions), `npm run build`, dan `git diff --check` lulus. Audit shell, Flux, auth/settings regression, aksesibilitas markup, token semantik, `wire:navigate`, dark mode, dan teknologi terlarang juga lulus.
- Phase 6: `vendor/bin/pint --dirty --format agent`, full Pest suite (66 tests / 424 assertions), `npm run build`, dan `git diff --check` lulus. Audit struktur dashboard, komponen, token, responsivitas, aksesibilitas, dependency, teknologi terlarang, dan scope Sidebar-07 juga lulus.
- Phase 7: `vendor/bin/pint --dirty --format agent`, full Pest suite (67 tests / 451 assertions), `npm run build`, dan `git diff --check` lulus. Audit struktur sidebar, desktop/icon mode, Sheet mobile, kontrak data tunggal, route aktif/nested, aksesibilitas markup, keyboard shortcut, `wire:navigate`, token semantik, dark mode, Flux, teknologi terlarang, dan regresi Dashboard-01 lulus.
- Phase 8: baseline test autentikasi lulus (18 tests / 41 assertions). Test autentikasi setelah migrasi mencakup rendering login, registration, password reset, email verification, password confirmation, two-factor, passkey route, autocomplete, status, dan asosiasi error ARIA (20 tests / 79 assertions). `vendor/bin/pint --dirty --format agent`, full suite (69 tests / 489 assertions), `npm run build`, `git diff --check`, serta audit Flux auth, token semantik, dan teknologi terlarang lulus.
- Phase 9: `vendor/bin/pint --dirty --format agent`, test Blade terfokus (2 tests / 16 assertions), test runtime Node bawaan (10 tests), full Pest suite (71 tests / 505 assertions), `npm run build`, dan `git diff --check` lulus. Audit default/stored/invalid theme, toggle, persistence, root class, header, Settings, Flux appearance, token, Livewire navigation contract, dan teknologi terlarang lulus.
- Phase 10: `vendor/bin/pint --dirty --format agent`, test terfokus Playground/shell/components (41 tests / 326 assertions), full Pest suite (81 tests / 528 assertions), `npm run build`, dan `git diff --check` lulus. Audit route/access policy, semua halaman kategori, komposisi component aktual, token semantic, Light/Dark root integration, dependency, Flux boundary, dan teknologi terlarang juga lulus.
- Phase 11: `vendor/bin/pint --dirty --format agent`, Unit+Feature suite (81 tests / 529 assertions), Browser suite Playwright Chromium (13 tests / 97 assertions), `npm run build`, dan `git diff --check` lulus. Audit browser mencakup JavaScript errors pada flow representatif, interaksi keyboard/focus, responsivitas desktop/tablet/mobile, route protection/auth login, dan axe level critical/serious pada mode terang.
- Phase 12: `vendor/bin/pint --dirty --format agent`, Unit+Feature suite (81 tests / 532 assertions), Browser suite Playwright Chromium (15 tests / 123 assertions), dan `npm run build` lulus. `composer audit` dan `npm audit --omit=dev` tidak menemukan advisory. Audit mencakup toast success/error/dismiss, Security Settings, passkey runtime, recovery codes, dialog hapus akun, tema, navigasi Livewire, dependency, dan referensi runtime Flux nol.

## Browser Testing

- `pestphp/pest-plugin-browser` dan Playwright Chromium telah dipasang sebagai development dependency. Extension PHP `sockets` juga diaktifkan pada CLI lokal karena merupakan requirement package Browser; perubahan ini berada di konfigurasi PHP lokal, bukan repository.
- `vendor/bin/pest tests/Browser --compact` lulus (15 tests / 123 assertions). Selain cakupan Phase 11, test memverifikasi toast success/error dan dismiss, update Profile, validasi Password, navigasi Settings `wire:navigate` dengan Dark persistence, runtime `@laravel/passkeys`, recovery code, dan dialog konfirmasi hapus akun.
- Audit runtime Browser tidak menemukan JavaScript error pada flow representatif yang diuji. Tidak ada API aplikasi eksternal atau network call baru yang ditambahkan; semua data Playground/Dashboard tetap lokal dan deterministik.
- Axe Browser dijalankan pada level critical/serious mode terang. Pada mode gelap, axe 4.10 memunculkan false positive pada custom property `oklch` walaupun Chromium menerapkan token foreground/background dark yang benar; audit dark didukung oleh state root, screenshot Chromium, dan inspeksi visual, bukan klaim WCAG formal.

## Known Risks

- Browser E2E tersedia, tetapi verifikasi assistive technology nyata (screen reader), alur passkey/WebAuthn yang memerlukan device credential, dan 2FA yang memerlukan secret/recovery code tetap memerlukan pemeriksaan manual. Ini bukan klaim kepatuhan WCAG formal.
- Back/forward history pada navigasi SPA belum diautomasi karena driver Pest Browser pada Windows dapat memblokir klik programatik `wire:navigate`; navigasi maju sendiri telah diverifikasi melalui event klik native dan marker halaman yang tetap ada.
- Trigger navigasi mobile memakai ukuran `sm` (`h-8`, 32px) dan icon control shell memakai `size-9` (36px), di bawah rekomendasi touch target 44px. Hal ini dicatat dari audit Phase 11 dan tidak diubah karena akan menjadi perubahan desain lintas komponen.
- Browser tidak menjalankan upacara WebAuthn nyata atau memindai QR 2FA; test hanya memverifikasi kontrol, runtime, error-safe UI, dan alur yang aman dijalankan di Chromium headless.
- Avatar fallback untuk gambar yang gagal memuat menggunakan handler error HTML minimal.
- Tabs memakai Alpine lokal untuk state aktif dan navigasi keyboard; tidak diikat ke state Livewire atau route aplikasi.
- Dialog, Sheet, Dropdown, Popover, Tooltip, Collapsible, Command, dan Tabs telah memiliki Browser coverage representatif. Focus trap ringan Dialog/Sheet tetap perlu verifikasi dengan screen reader nyata.
- Popover menggunakan anchor CSS minimal dan belum melakukan collision detection dinamis terhadap semua tepi viewport; konten dibatasi terhadap lebar viewport.
- Pest Browser pada Windows kadang menyisakan state server Playwright ketika proses test dihentikan paksa; hapus hanya file cache `vendor/pestphp/pest-plugin-browser/.temp/playwright-server.json` setelah memastikan proses runner terkait sudah berhenti sebelum menjalankan ulang.

## Next Phase

Phase 13 — Documentation.
