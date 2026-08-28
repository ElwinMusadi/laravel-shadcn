# Blocks

Block adalah komposisi reusable tingkat halaman yang menyatukan UI primitive dan, bila perlu, komponen aplikasi. Block tidak menggantikan halaman domain atau backend aplikasi.

## Dashboard-01

Lokasi utama: <code>resources/views/blocks/dashboard/dashboard-01.blade.php</code>.

Block ini menyusun:

- <code>section-cards.blade.php</code> untuk empat metrik.
- <code>chart-area.blade.php</code> untuk SVG chart dengan pilihan rentang Alpine lokal.
- <code>data-table.blade.php</code> untuk tabel demo dan action Dropdown.

Dashboard-01 menggunakan data statis lokal secara default: metrik, series chart, dan rows tabel. Ia aman direuse sebagai reference komposisi UI di dalam <code>x-layouts::app</code>, tetapi bukan analytics backend. Halaman domain atau Livewire Anda harus menyediakan data nyata, authorization, query, pagination, dan action bisnis.

~~~blade
<x-layouts::app
    :title="__('Dashboard')"
    :show-page-header="true"
>
    @include('blocks.dashboard.dashboard-01')
</x-layouts::app>
~~~

Chart memakai SVG responsif, title, description, serta alternatif teks <code>dt</code>/<code>dd</code>. Tabel dapat bergulir horizontal pada layar kecil. Gunakan block ini di bawah application shell agar header, sidebar, dan landmark tetap konsisten.

## Sidebar-07

Sidebar-07 adalah komposisi sidebar yang diimplementasikan oleh <code>x-app.shell</code>, <code>x-app.sidebar</code>, <code>x-app.navigation</code>, dan <code>x-app.workspace-switcher</code>; bukan include block tunggal di <code>resources/views/blocks/</code>.

- Desktop: sidebar dapat expanded atau collapsed.
- Mobile: header membuka sidebar pada <code>x-ui.sheet</code>.
- Data navigasi serta workspace didefinisikan sekali pada <code>x-app.shell</code>, lalu diteruskan ke desktop dan mobile.
- Active route memakai pola <code>request()->routeIs()</code>.
- Workspace switcher memakai data demo lokal.
- Shortcut <code>Ctrl/Cmd + B</code> mengubah collapse desktop di luar elemen editable.

Jangan menanamkan Sidebar-07 lagi di dalam halaman yang sudah memakai <code>x-layouts::app</code>. Lihat [Layouts & Pages](layouts-and-pages.md#sidebar-07).

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
