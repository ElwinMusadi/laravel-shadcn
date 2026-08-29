# Blocks

Block adalah komposisi reusable tingkat halaman yang menyatukan UI primitive dan, bila perlu, komponen aplikasi. Block tidak menggantikan halaman domain atau backend aplikasi.

## Dashboard-01

Lokasi utama: <code>resources/views/blocks/dashboard/dashboard-01.blade.php</code>.

Block ini menyusun:

- <code>section-cards.blade.php</code> untuk empat metrik.
- <code>chart-area.blade.php</code> untuk SVG chart dengan pilihan rentang Alpine lokal.
- <code>data-table.blade.php</code> untuk tabel demo dan action Dropdown.

Dashboard-01 adalah block dashboard kanonis. Ia menggunakan data statis lokal secara default: empat KPI, area chart dengan tiga rentang Alpine lokal, tabs/view controls, dan tabel dokumen. Ia aman direuse sebagai reference komposisi UI di dalam <code>x-layouts::app</code>, tetapi bukan analytics backend. Halaman domain atau Livewire Anda harus menyediakan data nyata, authorization, query, pagination, dan action bisnis.

~~~blade
<x-layouts::app
    :title="__('Documents')"
    :show-page-header="false"
>
    @include('blocks.dashboard.dashboard-01')
</x-layouts::app>
~~~

Chart memakai SVG area responsif, grid, label sumbu, title, description, serta alternatif teks <code>dt</code>/<code>dd</code>. Tabel memiliki checkbox, status badge, action menu, pengaturan kolom, serta pagination statis dan dapat bergulir horizontal pada layar kecil. Gunakan block ini di bawah application shell agar header, sidebar, dan landmark tetap konsisten.

## Sidebar aplikasi Dashboard-01

Sidebar Dashboard-01 adalah sidebar aplikasi kanonis dan diimplementasikan oleh <code>x-app.shell</code>, <code>x-app.sidebar</code>, <code>x-app.brand</code>, dan <code>x-app.navigation</code>; bukan include block tunggal di <code>resources/views/blocks/</code>.

- Desktop: sidebar lebar dan persisten secara default; trigger header atau <code>Ctrl/Cmd + B</code> menyembunyikan atau menampilkan sidebar tanpa mode ikon.
- Mobile: header membuka sidebar pada <code>x-ui.sheet</code>.
- Data navigasi didefinisikan sekali pada <code>x-app.shell</code>, lalu diteruskan ke desktop dan mobile.
- Active route memakai pola <code>request()->routeIs()</code>.
- Application Brand memakai logo dan nama dari <code>APP_NAME</code>, menaut ke route <code>dashboard</code> dengan <code>wire:navigate</code>, dan tidak menyediakan perpindahan workspace; footer memakai user dan email terautentikasi.
- Sheet menutup dengan Escape dan mengembalikan fokus ke trigger.

Sidebar-07 bukan lagi shell kanonis. Primitive yang pernah dipakai tetap dapat direuse bila sesuai, tetapi jangan menanamkan Sidebar-07 atau shell paralel di dalam halaman yang sudah memakai <code>x-layouts::app</code>.

## Login-04 dan Signup-04

Login-04 serta Signup-04 adalah komposisi presentasi yang hidup pada halaman Fortify:

- <code>resources/views/pages/auth/login.blade.php</code>
- <code>resources/views/pages/auth/register.blade.php</code>

Keduanya memakai <code>x-layouts::auth</code>, <code>x-auth-header</code>, <code>x-auth.password-field</code>, dan form primitive <code>x-ui.*</code>. Layout auth menampilkan card responsif satu kolom pada layar kecil serta panel visual pada desktop.

Jangan include halaman login/registration sebagai partial di dalam shell aplikasi. Pakai route Fortify agar CSRF, action, validasi, session, limiter, redirect, dan passkey contract tetap benar. Lihat [Authentication](authentication.md).

## Memilih jenis abstraksi

~~~text
Primitive visual generik?
  → UI component
Komposisi reusable khusus aplikasi?
  → App component
Komposisi reusable tingkat halaman?
  → Block
Layar khusus domain dan business flow?
  → Page
~~~

Lihat [Starter Kit Workflow](starter-kit-workflow.md#workflow-komponen-baru) sebelum membuat komponen atau block baru.
