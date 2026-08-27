# Project Status

## Current Phase

Phase 6 — Dashboard-01

## Completed

- Phase 0
- Phase 1 — Amber Design System Foundation
- Phase 2 — Core UI Components
- Phase 3 — Forms, Data and Navigation Components
- Phase 4 — Advanced Interaction Components
- Phase 5 — Application Shell
- Phase 6 — Dashboard-01

## Current Architecture

- Laravel, Livewire, Blade, Tailwind CSS 4, dan Alpine.js.
- Token semantik Amber dari Phase 1 adalah sumber kebenaran visual.
- Shell aplikasi berada di `resources/views/components/app/`; primitive tetap berada di `resources/views/components/ui/`.
- Flux tetap terpasang untuk halaman auth/settings serta runtime toast dan appearance yang belum dimigrasikan.
- Dashboard terlindungi tetap berada pada route `dashboard`, dengan komposisi spesifik di `resources/views/blocks/dashboard/` agar region navigasi shell dapat diganti pada Phase 7 tanpa membangun ulang konten dashboard.

## Component Inventory

- Core: Button, Card, Badge, Separator, Alert, Avatar, Skeleton, dan Heading/Typography.
- Forms: Field, Field Group, Label, Input, Textarea, Select, Checkbox, Radio Group, Switch, Field Description, dan Field Error.
- Data: Table dan Pagination.
- Navigation: Breadcrumb dan Tabs.
- Advanced Interaction: Dialog, Sheet, Dropdown Menu, Popover, Tooltip, Collapsible, dan Command.
- Application Shell: Shell, Brand, Header, Navigation, User Menu, dan Page Header.
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

## Flux Migration Boundary

- Dimigrasikan pada Phase 5: Flux sidebar, header, navbar, profile dropdown, menu shell, dan wrapper brand lama pada shell aplikasi.
- Dipertahankan pada shell: `@persist('toast')`, `flux:toast`, dan `@fluxScripts`, karena settings Livewire masih memanggil `Flux::toast` dan masih memakai kontrol Flux.
- Dipertahankan di luar shell: `@fluxAppearance` untuk Phase 9, halaman auth untuk Phase 8, serta penggantian runtime/dependensi Flux final untuk Phase 12.
- Tidak ada dependency Flux yang dihapus pada fase ini.

## Latest Validation

- Phase 1: Pint, test suite (35 tests / 126 assertions), `npm run build`, `git diff --check`, dan audit token semantik lulus.
- Phase 2: `vendor/bin/pint --dirty --format agent`, test suite (45 tests / 191 assertions), `npm run build`, `git diff --check`, dan audit token/teknologi lulus.
- Phase 3: `vendor/bin/pint --dirty --format agent`, test suite (54 tests / 273 assertions), `npm run build`, `git diff --check`, serta audit token, dark mode, Livewire, Flux, responsivitas, dan teknologi terlarang lulus.
- Phase 4: `vendor/bin/pint --dirty --format agent`, full Pest suite (61 tests / 371 assertions), `npm run build`, dan `git diff --check` lulus. Audit token semantik, dark mode, Alpine lokal, Livewire attribute forwarding, responsivitas, kompatibilitas Flux, dan teknologi terlarang juga lulus.
- Phase 5: `vendor/bin/pint --dirty --format agent`, full Pest suite (65 tests / 402 assertions), `npm run build`, dan `git diff --check` lulus. Audit shell, Flux, auth/settings regression, aksesibilitas markup, token semantik, `wire:navigate`, dark mode, dan teknologi terlarang juga lulus.
- Phase 6: `vendor/bin/pint --dirty --format agent`, full Pest suite (66 tests / 424 assertions), `npm run build`, dan `git diff --check` lulus. Audit struktur dashboard, komponen, token, responsivitas, aksesibilitas, dependency, teknologi terlarang, dan scope Sidebar-07 juga lulus.

## Browser Testing

- Project tidak memasang `pestphp/pest-plugin-browser`; browser E2E belum dijalankan hingga Phase 6.
- Test terfokus memverifikasi markup Alpine, state default, hubungan ARIA, handler keyboard, token semantik, komposisi, forwarding atribut Livewire, shell, navigasi aktif, breadcrumb, serta kontrak form logout.

## Known Risks

- Sidebar-07 belum diimplementasikan; Phase 6 sengaja hanya memakai navigation region dari shell Phase 5 agar Phase 7 dapat menggantinya.
- Browser E2E belum tersedia untuk memverifikasi pembaruan chart ketika kontrol rentang waktu dioperasikan dan perilaku assistive technology secara nyata.
- Auth, settings, appearance, dan toast masih memakai Flux pada batas yang telah dicatat untuk migrasi Phase 8, 9, dan 12.
- Avatar fallback untuk gambar yang gagal memuat menggunakan handler error HTML minimal.
- Tabs memakai Alpine lokal untuk state aktif dan navigasi keyboard; tidak diikat ke state Livewire atau route aplikasi.
- Dialog, Sheet, Dropdown, Popover, Tooltip, Collapsible, dan Command belum memiliki browser E2E otomatis. Khusus Dialog/Sheet, focus trap ringan telah diimplementasikan tetapi tetap perlu verifikasi browser asistif pada fase testing/accessibility khusus.
- Popover menggunakan anchor CSS minimal dan belum melakukan collision detection dinamis terhadap semua tepi viewport; konten dibatasi terhadap lebar viewport.

## Next Phase

Phase 7 — Sidebar-07.
