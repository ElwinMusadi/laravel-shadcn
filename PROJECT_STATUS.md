# Project Status

## Current Phase

Phase 15 — Dashboard-01 & Application Shell Re-alignment (Phase 15D.6: Selesai, Sidebar Transition & Animation Polish)

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
- Phase 13 — Documentation & Developer Handbook
- Phase 14 — Final Release Audit
- Phase 15D.6 — Sidebar Transition & Animation Polish

## Current Architecture

- Laravel, Livewire, Blade, Tailwind CSS 4, dan Alpine.js.
- Token semantik Amber dari Phase 1 adalah sumber kebenaran visual.
- Shell aplikasi berada di `resources/views/components/app/`; primitive tetap berada di `resources/views/components/ui/`.
- Tidak ada runtime dependency Flux. Toast, Settings Security, passkey registration, recovery-code management, dan dialog konfirmasi memakai komponen Blade/Alpine milik proyek.
- Dashboard terlindungi tetap berada pada route `dashboard`, dengan komposisi spesifik di `resources/views/blocks/dashboard/` agar region navigasi shell dapat diganti pada Phase 7 tanpa membangun ulang konten dashboard.
- Dashboard-01 adalah block dashboard kanonis dan sidebar Dashboard-01 adalah shell aplikasi kanonis; Sidebar-07 hanya merupakan referensi historis, bukan shell utama.
- Inter tetap menjadi font UI default melalui Bunny/Vite dan token `font-sans`; Source Serif 4 serta JetBrains Mono bersifat opt-in untuk konten khusus.
- `x-ui.icon` menyediakan subset SVG Lucide-compatible Blade-native untuk shell dan dashboard tanpa dependency frontend baru.
- UI Playground kanonis berada pada route authenticated + verified `ui.playground` (`/ui`) dengan halaman kategori di bawah `/ui/*`. Seluruh surface memakai `x-layouts::app`, komponen produksi, token semantik, serta data statis lokal.

## Component Inventory

- Core: Button, Card, Badge, Separator, Alert, Avatar, Skeleton, dan Heading/Typography.
- Forms: Field, Field Group, Label, Input, Textarea, Select, Checkbox, Radio Group, Switch, Field Description, dan Field Error.
- Data: Table dan Pagination.
- Navigation: Breadcrumb dan Tabs.
- Advanced Interaction: Dialog, Sheet, Dropdown Menu, Popover, Tooltip, Collapsible, dan Command.
- Application Shell: Shell, Brand, Header, Sidebar, Navigation, User Menu, dan Page Header.
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
- `x-app.theme-toggle` berada di header aplikasi dan memakai tooltip serta button UI existing. Tombol memiliki label dinamis, `aria-pressed`, status screen-reader, fokus terlihat, dan ikon Moon/Sun dari `x-ui.icon` Lucide-compatible tanpa dependency frontend baru.
- Settings Appearance memakai `x-ui.radio-group` dengan pilihan Light dan Dark saja. Kontrol Settings dan header menggunakan factory Alpine yang sama; state tampilan mereka hanya merefleksikan `<html>.dark` dan sinkron melalui event DOM `theme-changed`.
- Landing page, shell aplikasi, dan auth layout tidak lagi memaksa class `dark`, sehingga seluruh route utama, halaman authentication, sidebar, dan Dashboard-01 mengikuti root yang sama. Listener Livewire tunggal menggunakan lifecycle `livewire:navigating` dan `onSwap` untuk menerapkan ulang root sebelum script halaman baru berjalan; listener tidak diduplikasi. Token Amber Phase 1, chart tokens, dan arsitektur semantic-token tidak diubah.
- Ownership appearance telah dipindahkan dari Flux. Inversi QR setup 2FA sekarang mengikuti class `dark` pada root melalui varian Tailwind. `@fluxScripts`, `@persist('toast')`, `flux:toast`, Settings security, passkey registration, dan recovery-code management tetap dipertahankan.

## Phase 10 Architecture

- `ui.playground` (`/ui`) adalah titik masuk kanonis UI Playground. Halaman kategori Foundations, Components, Forms, Data Display, Navigation, Interaction, Application, Blocks, dan Authentication memakai route named sendiri di bawah middleware `auth` dan `verified`; route lama `ui.components` berevolusi menjadi halaman Components pada `/ui/components`, sehingga tidak ada showcase paralel.
- `x-playground.layout` membungkus `x-layouts::app`, sehingga Playground mewarisi Shell, Header, sidebar aplikasi Dashboard-01, Page Header, Theme Toggle, landmark, responsivitas, serta perilaku `wire:navigate` yang sama dengan aplikasi. Navigasi internal hanya memuat satu tautan UI Playground di sidebar aplikasi dan daftar kategori khusus pada konten Playground.
- Foundations menampilkan seluruh token semantic theme (termasuk chart dan sidebar), font configured, `radius-sm` hingga `radius-xl`, dan shadow scale aktual. Tidak ada raw color, font, radius, shadow, atau token baru; Light dan Dark berasal dari controller root yang sudah ada dan tidak memiliki mode ketiga.
- Semua preview merender `x-ui.*`, `x-app.*`, `x-auth.password-field`, atau `Dashboard-01` aktual. Forms, table, pagination, command, dan menu memakai data contoh deterministik di Blade tanpa query database, API, state server, atau business logic baru.
- Interactive demos memakai implementasi Alpine lokal yang ada untuk Dialog, Sheet empat sisi, Dropdown, Popover, Tooltip, Collapsible, dan Command. API notes dan contoh Blade singkat merujuk pada atribut yang benar-benar didukung setiap component.
- Blocks menampilkan `Dashboard-01` langsung. Sidebar aplikasi Dashboard-01 sudah merupakan shell yang mengelilingi halaman dan tidak di-embed berulang; Login-04 dan Signup-04 direferensikan melalui route Fortify dan shell auth aktual agar tidak membuat document/shell bersarang atau menjalankan operasi auth dari Playground.
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

## Phase 13 Documentation

- `README.md` menjadi entry point ringkas untuk stack, fitur utama, instalasi, perintah development, struktur proyek, penggunaan Starter Kit, panduan AI, dan indeks dokumentasi.
- Handbook developer berada di `docs/`: architecture, getting started, components, forms, interactions, blocks, theming, layouts/pages, Livewire/Alpine, authentication, testing, accessibility, AI development, Starter Kit workflow, troubleshooting, dan contributing.
- Dokumentasi menjelaskan implementasi aktual: UI primitive `x-ui.*`, `x-ui.icon` Lucide-compatible, komponen aplikasi `x-app.*`, password field `x-auth.password-field`, Dashboard-01 dan sidebar aplikasi kanonis, Login-04/Signup-04, UI Playground `/ui`, token Amber, dan runtime tema Light/Dark.
- Fortify tetap didokumentasikan sebagai pemilik kontrak autentikasi; presentation Blade/Livewire/Alpine, `@laravel/passkeys`, dan toast project-owned didokumentasikan tanpa mengubah kontrak backend.
- Panduan testing membedakan Unit/Feature, Browser Pest/Playwright Chromium, validasi otomatis, dan QA aksesibilitas manual. Panduan workflow menegaskan source-of-truth repository, Git safety, batas AI, serta pemisahan infrastruktur Starter Kit dari kode domain.

## Phase 14 — Final Release Audit

- Scope mencakup integritas repository, arsitektur, dependency, token dan theme runtime, komponen, shell, block, Fortify, Livewire/Alpine, testing, browser, aksesibilitas, keamanan, performa, font, Playground, dokumentasi, aturan AI, reusability, dan Git hygiene.
- Arsitektur lulus: UI tetap Blade-native dengan Laravel, Livewire 4, Blade, Alpine lokal, Tailwind CSS 4, dan token Amber semantik. Primitive UI tidak memiliki query database atau business logic; block dan Playground memakai data demo lokal deterministik.
- Keamanan lulus setelah perbaikan P1: `App\Models\User` kini mengimplementasikan `MustVerifyEmail`, sehingga middleware `verified` benar-benar mengalihkan akun belum terverifikasi ke notice Fortify. Test Feature khusus melindungi kontrak tersebut.
- Dependency lulus: tidak ada advisory dari `composer audit` atau `npm audit --omit=dev`. Tidak ada dependency langsung Flux, React, Vue, Inertia, Next, TypeScript, JSX/TSX, Radix, Base UI, Floating UI, TanStack, Sonner, atau Fuse.js.
- Flux lulus: tidak ada referensi runtime Flux. Satu entri pada `composer.lock` hanya merupakan conflict dan require-dev upstream `livewire/blaze`, bukan dependency aplikasi.
- Browser, aksesibilitas, dan responsivitas lulus pada coverage representatif desktop, tablet, serta mobile. Suite Browser memeriksa JavaScript error dan axe pada flow inti; ini bukan sertifikasi WCAG atau pengganti QA pembaca layar/WebAuthn nyata.
- Performa lulus secara targeted: build Vite menghasilkan CSS aplikasi 55.32 kB (gzip 9.96 kB), runtime passkey 12.08 kB (gzip 3.90 kB), dan aset font lokal. Bunny tetap diperlukan saat build untuk mengambil font karena `optimizedFallbacks: false`; kondisi ini terdokumentasi dan bukan blocker.
- Dokumentasi, aturan AI, dan reusability lulus setelah klarifikasi bahwa Bunny adalah sumber font saat build, sedangkan Vite mengirim aset font lokal. Starter dapat dikustomisasi melalui `APP_NAME`, branding/logo, data shell demo, navigasi, block, theme, route/page Livewire, dan Fortify tanpa coupling domain.
- Klasifikasi blocker: tidak ada P0 atau P1 terbuka. P1 verifikasi email telah diperbaiki. P2 tersisa hanya penggunaan utilitas palette mentah `stone`/`zinc` pada presentasi setup 2FA/recovery code; tidak memengaruhi perilaku, keamanan, atau gate rilis. P3 mencakup touch target shell di bawah 44px pada sebagian control dan kebutuhan koneksi Bunny saat build font.
- Status rilis akhir: **GO WITH KNOWN TECHNICAL DEBT**.

## Phase 15 — Dashboard-01 & Application Shell Re-alignment

- Dashboard-01 kembali menjadi block kanonis dengan empat KPI referensi, area chart SVG responsif, kontrol rentang, tabs/view controls, tabel dokumen statis, checkbox, column control, action menu, dan pagination presentasional.
- Sidebar aplikasi sekarang mengikuti komposisi Dashboard-01: header berbasis `APP_NAME`, Quick Create, Inbox, grup Documents, utilitas bawah, dan footer user terautentikasi. Sidebar-07 tidak lagi menjadi shell kanonis; mode icon-collapse dihapus dan trigger desktop menyembunyikan atau menampilkan sidebar penuh.
- `x-ui.icon` adalah strategi ikon reusable baru: subset SVG Lucide-compatible yang dirender di Blade dan dipakai oleh shell, dashboard, serta theme toggle. Tidak ada dependency Composer atau npm baru.
- Inter tetap menjadi font UI default dari mekanisme Bunny/Vite yang sudah ada. Token Amber Minimal, `localStorage.theme`, `<html>.dark`, Fortify, Livewire, dan data dashboard statis tetap dipertahankan.
- Audit visual setelah build dilakukan pada 1440×900, 1024×900, dan 390×844. Struktur sidebar, header, grid KPI, chart, tabs, tabel horizontal, serta layout mobile diperiksa; ini bukan klaim parity pixel-perfect atau sertifikasi WCAG.
- Phase 15B menyesuaikan shell aplikasi (`x-app.shell`, `x-app.header`, `x-app.sidebar`) agar menyamai hierarki dan density dari shadcn Dashboard-01 v4. Breadcrumb sekarang diletakkan di dalam top header, dan page-header mandiri direfaktor untuk tidak lagi menampilkan breadcrumbs, sementara sidebar width dikurangi menjadi 16rem.
- Phase 15B.1 memperbaiki issue di mana user menu & footer area bocor / overflow dari lebar sidebar. Memperbaiki container `ui.dropdown` dengan memastikan properti `min-w-0` pada trigger (sebagai flex child) digunakan untuk mencegah _text blowout_, sekaligus menerapkan `h-[calc(100svh-1rem)] sticky top-2` untuk desktop sidebar agar navigation area scrollable mandiri, dan footer tertambat stabil di bagian bawah sidebar. Di mobile, sidebar menjadi `flex-1 min-h-0` sehingga fungsionalitas `sheet` tetap sempurna.
- Phase 15C mereproduksi hierarki, proporsi, padding, tipografi metrik, badge, dan integrasi kontainer Data Table agar selaras murni dengan desain resmi Dashboard-01. Kartu metrik sekarang merespons dari kolom tunggal ke 2 kolom lalu ke 4 kolom tanpa kekakuan ukuran. Struktur Data Table disematkan dalam wrapper `rounded-md border` dan disokong komponen overflow-x-auto, melindungi dari pemuaian horisontal pada mobile.
- Phase 15D menyelesaikan empat isu visual spesifik untuk menyamai referensi: (1) Menyinkronkan tinggi sidebar header (via switcher `h-8`) dan main header (`h-12`) sehingga baseline-nya presisi `48px`, (2) Memperbaiki tipografi navigation label menjadi `h-8 items-center`, button label ke `text-sm`, dan memindahkan font weight reguler untuk menu inactive, (3) Memperbaiki top corner clipping pada container content Dashboard dengan `lg:overflow-clip` yang mencegah background header keluar dari lengkungan corner tanpa merusak `position: sticky` pada mobile, (4) Menyamakan komposisi pagination Data Table menggunakan primitive UI yang telah ada.
- Phase 15D.1 memperbaiki anomali tinggi elemen dan struktur _scroll_. Memperbaiki over-expansion pada area workspace-switcher dengan pemaksaan batas tinggi `!h-8` sehingga sidebar header dan main header setara presisi (keduanya kini merender tepat di profil 49px termasuk _border_). Menyempurnakan layout shell aplikasi dengan mengganti _viewport min-height_ fleksibel (`min-h-svh`) menjadi statis (`h-svh`) dan membungkus blok _main content_ dengan konteks scroll independen (`min-h-0 overflow-y-auto`). Main header kini tetap stasioner di atas dan menolak bergeser mengikuti konten ke atas, sesuai dengan tata letak dashboard modern dan responsif.
- Phase 15D.2 dijalankan ulang setelah verifikasi Chromium menemukan root document masih dapat tumbuh dari 900 px menjadi 937 px pada 1024×900 dan 976 px pada 768×900 ketika Dashboard panjang. `main` sendiri sudah menjadi scroll container yang benar (`min-h-0 overflow-y-auto`), tetapi main application region belum menjadi _layout containment boundary_; akibatnya overflow layout dari pasangan header dan konten dapat terpropagasi ke root document. Utility `contain-layout` pada region tersebut menghentikan propagasi ini tanpa menyembunyikan overflow secara global, sementara `lg:overflow-clip` tetap menjaga clipping sudut frame.
- Sidebar desktop mempertahankan arsitektur mandiri: header dan footer `shrink-0`, navigasi tengah `flex-1 min-h-0 overflow-y-auto`, serta `aside` berbatas viewport. Navigasi panjang kini menggulir pada area middle tanpa menggeser header, profil, atau document. Pada mobile, Sheet tetap memakai scroll container-nya sendiri dan tidak dipaksa memakai pola desktop.
- Validasi pengulangan: `vendor/bin/pint --dirty --format agent`, Unit+Feature (84 test / 550 assertion), build Vite, dan `git diff --check` lulus. Browser Chromium deterministik lulus untuk document/main scroll (2 test / 21 assertion), sidebar desktop dan Sheet mobile (2 test / 14 assertion), alignment header (1 test / 3 assertion), serta navigasi Livewire representatif (1 test / 6 assertion). Aggregate Browser suite dihentikan setelah 120 detik tanpa output pada teardown Playwright Windows; hasilnya tidak diklaim lulus.
- Phase 15D.3 memperbaiki regresi Sheet sidebar mobile yang muncul setelah containment scroll Phase 15D.2. Inspeksi Chromium pada 390×844 membuktikan DOM sudah benar: sidebar mobile adalah turunan Sheet dan Dashboard bukan turunan Sheet. Root cause-nya visual: `backdrop-blur` pada header membentuk containing block untuk elemen `fixed`, sehingga `h-full` pada panel Sheet hanya menyelesaikan tinggi header 48 px dan sidebar menyusut menjadi 0 px. Overlay dan panel side Sheet kini memakai `h-dvh`, sehingga panel selalu setinggi dynamic viewport tanpa mengubah komposisi Blade, data navigasi bersama, dashboard, atau shell desktop.
- Navigasi mobile kembali tampil penuh di bawah header Sheet dan tetap memakai `flex-1 min-h-0 overflow-y-auto` pada sidebar yang sama. Header Sheet, workspace/brand, Quick Create, Inbox, grup navigasi, dan footer profil tetap berada pada komposisi tunggal; Escape dan fokus kembali ke trigger tetap berfungsi. Cakupan Browser menegaskan `sheet.contains(sidebar)`, `!sheet.contains(dashboard)`, panel/backdrop menutupi viewport, scroll navigasi, pembukaan ulang, serta komposisi setelah pergi-pulang `wire:navigate`.
- Phase 15D.4 memperbaiki Settings mobile yang tampak flush terhadap viewport tanpa mengubah desain Settings, Dashboard, sidebar, header, atau scroll shell. Root cause-nya adalah `main` hanya memiliki gutter ketika `showPageHeader=true`; Dashboard aman karena block-nya memiliki spacing sendiri, sedangkan root Settings Livewire memakai `showPageHeader=false` dan masuk langsung ke main.
- `x-app.page-container` menjadi kontrak tunggal halaman aplikasi terautentikasi: `box-border`, gutter responsif `px-4 sm:px-6 lg:px-8`, padding vertikal, dan gap halaman berada di dalam satu main scroll region. Shell memakai container yang sama untuk jalur kompatibilitas `showPageHeader=true`; Profile, Appearance, dan Security Settings memakainya secara eksplisit. Constraint `max-w-lg` milik form Settings tetap berada pada child, sehingga Dashboard tidak diubah atau dipersempit.
- Dokumentasi layout/component dan aturan proyek mencatat konvensi halaman baru: satu page container per halaman, tidak boleh menjadi scroll container, dan padding page tidak diinventasikan per halaman. Browser terfokus memeriksa Profile Settings pada 390×844, 768×900, 1024×900, dan 1440×900: heading, nav, field, serta button berada di dalam content gutter; document tidak overflow secara horizontal/vertikal dan `main` tetap `overflow-y-auto`.
- Phase 15D.5 menghapus Workspace Switcher yang hanya dipakai header Sidebar. Root cause-nya adalah komponen `x-app.workspace-switcher` masih merender `x-ui.dropdown`, state Alpine workspace, menu, dan chevron meskipun Starter Kit tidak memiliki capability perpindahan workspace.
- Header Sidebar desktop dan Sheet mobile kini memakai `x-app.brand` dengan varian sidebar: logo dan `APP_NAME` tetap sama, seluruh area `h-8` menjadi anchor normal `wire:navigate` ke named route autentikasi `dashboard`, tanpa state, menu, chevron, atau ARIA dropdown. Header, navigation scroll, footer profil, Sheet, tema Light/Dark, tipografi Inter, dan sistem ikon tidak diubah.
- Cakupan Feature memverifikasi anchor, route, nama aplikasi, tinggi kontrol, focus-visible, serta ketiadaan semantik/menu workspace. Cakupan Browser memverifikasi pointer dan Enter navigation, state Dashboard aktif, footer, dan Sheet mobile pada 390×844, 768×900, 1024×900, serta 1440×900. Tidak ada dependency Composer atau npm ditambah/diubah.
- Phase 15D.6 menambahkan transisi Sidebar desktop berbasis CSS tanpa mengubah state Alpine `sidebarExpanded`: lebar panel, perpindahan horizontal ke kiri, opacity, dan gap shell berubah bersama selama `200ms` dengan `ease-linear`. Sidebar tetap berada pada flex shell selama animasi agar main content tidak melompat, lalu menjadi `inert` dan `aria-hidden` saat tertutup; `id="application-sidebar"` kini juga memenuhi relasi `aria-controls` trigger desktop.
- Primitive `x-ui.sheet` sekarang mempertahankan wrapper selama durasi transisi, memudarkan backdrop melalui opacity, dan menggeser panel secara generik dari sisi `top`, `right`, `bottom`, atau `left` memakai transform `200ms ease-linear`. Sheet Sidebar mobile tetap memakai arsitektur yang sama, termasuk Escape, focus return, focus trap, `h-dvh`, dan scroll internal.
- Header/footer Sidebar tetap `shrink-0`; navigation tengah tetap `flex-1 min-h-0 overflow-y-auto`; shell `h-svh`, `contain-layout`, main scroll region, tinggi/alignment header, Livewire navigation, Amber Minimal, Inter, dan `x-ui.icon` tidak diubah. Tidak ada dependency Composer/npm yang ditambah atau diubah.

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
- Phase 13: 17 berkas Markdown baru atau diperbarui (README dan handbook docs) telah diaudit terhadap source, component API, route, configuration, dan test aktual. Seluruh tautan Markdown diverifikasi. Unit+Feature suite (81 tests / 532 assertions), Browser suite Playwright Chromium (15 tests / 123 assertions), `npm run build`, `vendor/bin/pint --dirty --format agent`, `git diff --check`, `composer audit`, dan `npm audit --omit=dev` lulus.
- Phase 14: audit rilis menemukan dan memperbaiki enforcement email verification pada middleware `verified`. Unit+Feature suite (82 tests / 534 assertions), Browser suite Playwright Chromium (15 tests / 123 assertions), `npm run build`, `vendor/bin/pint --dirty --format agent`, `git diff --check`, `composer audit`, dan `npm audit --omit=dev` lulus.
- Phase 15: Unit+Feature suite (84 tests / 550 assertions), `npm run build`, `vendor/bin/pint --dirty --format agent`, dan `git diff --check` lulus. Test browser lokal dihentikan karena bug teardown process Windows, pengujian visual manual digunakan sebagai verifikasi fallback.
- Phase 15D.2: `contain-layout` memulihkan boundary scroll shell tanpa mengubah Dashboard. Unit+Feature suite (84 tests / 550 assertions), Pint, Vite build, dan diff check lulus. Enam test Chromium deterministik (44 assertion) mencakup document/main scroll, sidebar desktop, Sheet mobile, alignment header, dan `wire:navigate`; aggregate Browser suite kembali macet pada teardown Windows setelah 120 detik sehingga tidak dinyatakan lulus.
- Phase 15D.3: panel side Sheet menggunakan `h-dvh` untuk mengatasi fixed-position containing block dari header yang memakai backdrop blur. Pint dan Unit+Feature suite (84 tests / 550 assertions) lulus. Browser terfokus `SidebarScrollTest` (3 tests / 32 assertions) dan `DocumentScrollTest` (2 tests / 21 assertions) lulus. Percobaan aggregate dan dua file Browser lain macet tanpa keluaran pada startup/teardown Playwright Windows sehingga tidak dinyatakan lulus; proses spesifik run tersebut dihentikan setelah diverifikasi.
- Phase 15D.4: Pint, Unit+Feature suite (85 tests / 555 assertions), dan Vite build lulus. Browser terfokus untuk page container Settings lulus (1 test / 29 assertions) pada empat breakpoint; `DocumentScrollTest` (2 tests / 21 assertions), `SidebarScrollTest` (3 tests / 32 assertions), dan `ShellAlignmentTest` (1 test / 3 assertions) juga lulus. Aggregate `SettingsBrowserTest` dan `NavigationBrowserTest` tidak dinyatakan lulus karena axe melaporkan issue shell yang sudah ada: trigger sidebar desktop memiliki `aria-controls="application-sidebar"` tanpa ID target yang sesuai; scope Phase 15D.4 melarang perubahan header/sidebar.
- Phase 15D.5: `vendor/bin/pint --dirty --format agent`, `npm run build`, dan Unit+Feature suite (86 tests / 572 assertions) lulus. Browser terfokus Application Brand lulus (2 tests / 31 assertions) pada 390×844, 768×900, 1024×900, dan 1440×900, termasuk pointer/keyboard navigation serta `assertNoJavaScriptErrors()`. Aggregate `vendor/bin/pest tests/Browser --compact` tidak dinyatakan lulus: tidak menghasilkan output dan macet pada teardown Playwright Windows; proses run terbaru dihentikan setelah identifikasi PID/child process yang eksplisit, tanpa menghentikan proses lain yang sudah ada.
- Phase 15D.6: `vendor/bin/pint --dirty --format agent`, Unit+Feature suite (86 tests / 582 assertions), dan `npm run build` lulus. Browser terfokus lulus secara terpisah: transisi Sidebar desktop pada 1024×900 dan 1440×900 (1 test / 14 assertions), Sheet/sidebar scroll pada 390×844 dan 768×900 (3 tests / 33 assertions), DocumentScroll (2 tests / 21 assertions), ShellAlignment (1 test / 3 assertions), dan Settings termasuk axe critical/serious (3 tests / 55 assertions). Aggregate `vendor/bin/pest tests/Browser --compact` kembali macet tanpa output pada Windows dan dihentikan hanya untuk PID Pest/Playwright yang dibuat oleh run tersebut; suite agregat tidak diklaim lulus.

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

Tindak lanjut berikutnya:
Menunggu instruksi pengguna untuk transisi ke fase/pengembangan fitur selanjutnya.
