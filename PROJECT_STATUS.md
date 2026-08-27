# Project Status

## Current Phase

Phase 9 — Theme Controller / Appearance

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

## Current Architecture

- Laravel, Livewire, Blade, Tailwind CSS 4, dan Alpine.js.
- Token semantik Amber dari Phase 1 adalah sumber kebenaran visual.
- Shell aplikasi berada di `resources/views/components/app/`; primitive tetap berada di `resources/views/components/ui/`.
- Flux tetap terpasang untuk Settings selain appearance, runtime toast, passkey registration, dan recovery-code management.
- Dashboard terlindungi tetap berada pada route `dashboard`, dengan komposisi spesifik di `resources/views/blocks/dashboard/` agar region navigasi shell dapat diganti pada Phase 7 tanpa membangun ulang konten dashboard.

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

## Flux Migration Boundary

- Dimigrasikan pada Phase 5: Flux sidebar, header, navbar, profile dropdown, menu shell, dan wrapper brand lama pada shell aplikasi.
- Dimigrasikan pada Phase 7: region navigasi header Phase 5 digantikan sidebar desktop dan Sheet mobile Blade-native. Flux tidak menangani sidebar, navigasi mobile, collapse, atau rendering navigasi.
- Dimigrasikan pada Phase 8: layout, halaman, form, header/status, serta passkey verification autentikasi. Halaman auth aktif tidak lagi memakai presentasi Flux.
- Dimigrasikan pada Phase 9: bootstrap dan controller appearance, toggle header, pilihan Appearance Settings, serta dependency QR setup 2FA terhadap state appearance Flux.
- Dipertahankan pada shell: `@persist('toast')`, `flux:toast`, dan `@fluxScripts`, karena settings Livewire masih memanggil `Flux::toast` dan masih memakai kontrol Flux.
- Dipertahankan di luar shell: Settings selain appearance, recovery code/passkey management, toast runtime, serta penggantian runtime/dependensi Flux final untuk Phase 12.
- Tidak ada dependency Flux yang dihapus pada fase ini.

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

## Browser Testing

- Project tidak memasang `pestphp/pest-plugin-browser`; browser E2E belum dijalankan hingga Phase 9. Validasi browser berikutnya perlu mencakup first paint Light default, stored Light/Dark, toggle, persistensi reload dan `wire:navigate`, fallback localStorage, serta aksesibilitas keyboard dan screen reader.
- Test terfokus memverifikasi markup Alpine, state default, hubungan ARIA, handler keyboard, token semantik, komposisi, forwarding atribut Livewire, shell, navigasi aktif, breadcrumb, serta kontrak form logout.

## Known Risks

- Browser E2E belum tersedia untuk memverifikasi pembaruan chart ketika kontrol rentang waktu dioperasikan dan perilaku assistive technology secara nyata, serta interaksi responsif auth, password visibility, two-factor, passkey, fokus, dan screen reader.
- Settings selain appearance dan toast masih memakai Flux pada batas yang telah dicatat untuk migrasi Phase 12. Halaman auth aktif dan ownership appearance tidak lagi memakai presentasi Flux.
- Avatar fallback untuk gambar yang gagal memuat menggunakan handler error HTML minimal.
- Tabs memakai Alpine lokal untuk state aktif dan navigasi keyboard; tidak diikat ke state Livewire atau route aplikasi.
- Dialog, Sheet, Dropdown, Popover, Tooltip, Collapsible, dan Command belum memiliki browser E2E otomatis. Khusus Dialog/Sheet, focus trap ringan telah diimplementasikan tetapi tetap perlu verifikasi browser asistif pada fase testing/accessibility khusus.
- Popover menggunakan anchor CSS minimal dan belum melakukan collision detection dinamis terhadap semua tepi viewport; konten dibatasi terhadap lebar viewport.

## Next Phase

Phase 10 — UI Playground.
