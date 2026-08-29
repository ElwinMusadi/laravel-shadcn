# Layouts & Pages

## Layout aplikasi

<code>x-layouts::app</code> meneruskan <code>title</code>, <code>description</code>, <code>breadcrumbs</code>, dan <code>showPageHeader</code> ke <code>x-app.shell</code>. Shell menyusun skip link, sidebar, header, landmark <code>main</code> yang menjadi satu-satunya scroll region konten, toast, dan Livewire scripts.

~~~blade
<x-layouts::app
    :title="__('Projects')"
    :description="__('All active projects')"
    :breadcrumbs="[['label' => __('Dashboard'), 'route' => 'dashboard'], ['label' => __('Projects')]]"
    :show-page-header="true"
>
    ...
</x-layouts::app>
~~~

<code>x-app.page-header</code> mendukung slot bernama <code>actions</code>. Breadcrumb berada pada <code>x-app.header</code>; itemnya berisi <code>label</code>, serta dapat berisi <code>route</code> dan <code>parameters</code>.

## Standard Page Container

<code>x-app.page-container</code> adalah kontrak layout untuk halaman aplikasi terautentikasi. Komponen ini harus menjadi child langsung dari slot <code>x-layouts::app</code> atau root halaman Livewire yang sudah memakai shell. Ia memberi gutter responsif <code>px-4</code>, <code>sm:px-6</code>, dan <code>lg:px-8</code>, padding vertikal, serta gap halaman yang konsisten tanpa membentuk scroll region baru.

~~~blade
<x-layouts::app :title="__('Projects')">
    <x-app.page-container>
        <x-app.page-header
            :title="__('Projects')"
            :description="__('All active projects')"
        />

        <div class="max-w-3xl">
            ...
        </div>
    </x-app.page-container>
</x-layouts::app>
~~~

Gunakan satu page container per halaman. Jangan menambahkan padding viewport acak pada content page, dan jangan menaruh <code>overflow-y-auto</code> pada container ini. Halaman dapat memakai constraint lebar internal sesuai kebutuhan—misalnya form Settings memakai <code>max-w-lg</code>—tanpa mempersempit Dashboard atau halaman lain secara global. Untuk kompatibilitas, ketika <code>showPageHeader=true</code>, shell membungkus page header dan slot ke dalam container yang sama.

## Application shell

Shell mendefinisikan default navigation dan workspace demo satu kali, kemudian meneruskannya ke desktop sidebar serta Sheet mobile. Props shell <code>navigation</code> dan <code>workspaces</code> memungkinkan halaman mengganti data tersebut tanpa menduplikasi komposisi.

<code>x-app.header</code> sticky di atas. Pada desktop ia memiliki trigger untuk menampilkan atau menyembunyikan sidebar; pada mobile ia membuka Sheet navigasi. Theme toggle selalu berada pada header. <code>x-app.sidebar</code> menempatkan workspace switcher, navigasi, dan user menu.

## Sidebar aplikasi Dashboard-01

Pada layar besar sidebar Dashboard-01 menggunakan state Alpine lokal <code>sidebarExpanded</code> dari <code>x-app.shell</code>. Sidebar memakai lebar <code>--app-sidebar-expanded</code>, tampil persisten secara default, dan dapat disembunyikan dari viewport dengan trigger header; tidak ada mode icon-collapse.

Pada layar kecil, sidebar dirender di dalam <code>x-ui.sheet</code> dan selalu menunjukkan label lengkap. Drawer mobile dan visibilitas desktop adalah state terpisah. Sheet mendukung Escape, focus trap ringan, serta pengembalian fokus ke trigger. Item aktif memakai <code>request()->routeIs()</code> dan link aplikasi memakai <code>wire:navigate</code>.

Shortcut <code>Ctrl+B</code> atau <code>Cmd+B</code> mengubah visibilitas sidebar desktop, kecuali fokus berada pada input, select, textarea, atau elemen contenteditable. Sidebar-07 tidak lagi menjadi shell aplikasi kanonis.

## Layout autentikasi

<code>x-layouts::auth</code> mendelegasikan ke <code>x-layouts::auth.simple</code>. Ia memberikan card responsif, area form, brand, dan panel visual desktop. <code>x-layouts::auth.card</code> serta <code>x-layouts::auth.split</code> juga mendelegasikan ke layout yang sama; jangan membuat shell auth paralel.

Halaman auth memakai route Fortify dan bukan application shell. Lihat [Authentication](authentication.md).

## Halaman dan settings

- Dashboard view memakai <code>x-layouts::app</code> dan include Dashboard-01.
- Settings Profile, Appearance, dan Security adalah halaman Livewire 4 di <code>resources/views/pages/settings/</code>.
- Settings memakai <code>x-app.page-container</code> di atas heading, nav, dan content, lalu layout settings menyediakan nav Profile, Security, dan Appearance dengan <code>wire:navigate</code>.

Bangun halaman domain baru sebagai Blade page atau Livewire page sesuai kebutuhan server state dan selalu mulai dari <code>x-app.page-container</code>. Letakkan business logic, query, authorization, dan validasi di lapisan aplikasi, bukan di komponen UI.

## Navigation dan data

<code>x-ui.breadcrumb</code> terdiri dari <code>item</code>, <code>link</code>, <code>page</code>, dan <code>separator</code>. Breadcrumb menerima prop <code>label</code>; page saat ini memakai <code>aria-current="page"</code>.

<code>x-ui.table</code> adalah wrapper responsive yang menyediakan <code>caption</code>, <code>header</code>, <code>body</code>, <code>footer</code>, <code>row</code>, <code>head</code>, dan <code>cell</code>. Ia menambahkan overflow horizontal tetapi tidak melakukan query, sorting, filtering, atau pagination database.

<code>x-ui.pagination</code> adalah navigasi presentasional dengan <code>item</code>, <code>link</code>, <code>previous</code>, <code>next</code>, dan <code>ellipsis</code>. Link menerima <code>href</code>, <code>active</code>, dan <code>disabled</code>. Hubungkan sendiri ke paginator Laravel atau data domain Anda.

## UI Playground

Route <code>/ui</code> bernama <code>ui.playground</code> dan memerlukan <code>auth</code> serta <code>verified</code>. Halaman kategori adalah:

- <code>/ui/foundations</code>
- <code>/ui/components</code>
- <code>/ui/forms</code>
- <code>/ui/data-display</code>
- <code>/ui/navigation</code>
- <code>/ui/interaction</code>
- <code>/ui/application</code>
- <code>/ui/blocks</code>
- <code>/ui/authentication</code>

UI Playground adalah Living Design System: ia merender <code>x-ui.*</code>, <code>x-app.*</code>, <code>x-auth.password-field</code>, dan Dashboard-01 produksi dalam shell aplikasi aktual. Ia bukan showcase paralel dan tidak memiliki API atau komponen khusus yang berbeda dari produksi.

Gunakan Playground untuk QA manual Light/Dark, variant, state, keyboard/focus, dan perilaku responsive setelah perubahan UI.
