# Layouts & Pages

## Layout aplikasi

<code>x-layouts::app</code> meneruskan <code>title</code>, <code>description</code>, <code>breadcrumbs</code>, dan <code>showPageHeader</code> ke <code>x-app.shell</code>. Shell menyusun skip link, sidebar, header, landmark <code>main</code>, page header opsional, toast, dan Livewire scripts.

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

<code>x-app.page-header</code> mendukung slot bernama <code>actions</code>. Breadcrumb item berisi <code>label</code>, serta dapat berisi <code>route</code> dan <code>parameters</code>.

## Application shell

Shell mendefinisikan default navigation dan workspace demo satu kali, kemudian meneruskannya ke desktop sidebar serta Sheet mobile. Props shell <code>navigation</code> dan <code>workspaces</code> memungkinkan halaman mengganti data tersebut tanpa menduplikasi komposisi.

<code>x-app.header</code> sticky di atas. Pada desktop ia memiliki trigger collapse; pada mobile ia membuka Sheet navigasi. Theme toggle selalu berada pada header. <code>x-app.sidebar</code> menempatkan workspace switcher, navigasi, dan user menu.

## Sidebar-07

Pada layar besar sidebar menggunakan state Alpine lokal <code>sidebarExpanded</code> dari <code>x-app.shell</code>. Saat collapsed, lebar memakai custom property <code>--app-sidebar-collapsed</code> dan label visual disembunyikan sambil mempertahankan <code>aria-label</code> serta <code>title</code>.

Pada layar kecil, sidebar dirender di dalam <code>x-ui.sheet</code> dan selalu menunjukkan label lengkap. Drawer mobile serta collapse desktop adalah state terpisah. Navigasi child menggunakan <code>x-ui.collapsible</code>; item aktif memakai <code>request()->routeIs()</code> dan link aplikasi memakai <code>wire:navigate</code>.

Shortcut <code>Ctrl+B</code> atau <code>Cmd+B</code> mengubah sidebar desktop, kecuali fokus berada pada input, select, textarea, atau elemen contenteditable.

## Layout autentikasi

<code>x-layouts::auth</code> mendelegasikan ke <code>x-layouts::auth.simple</code>. Ia memberikan card responsif, area form, brand, dan panel visual desktop. <code>x-layouts::auth.card</code> serta <code>x-layouts::auth.split</code> juga mendelegasikan ke layout yang sama; jangan membuat shell auth paralel.

Halaman auth memakai route Fortify dan bukan application shell. Lihat [Authentication](authentication.md).

## Halaman dan settings

- Dashboard view memakai <code>x-layouts::app</code> dan include Dashboard-01.
- Settings Profile, Appearance, dan Security adalah halaman Livewire 4 di <code>resources/views/pages/settings/</code>.
- Layout settings memiliki nav Profile, Security, dan Appearance dengan <code>wire:navigate</code>.

Bangun halaman domain baru sebagai Blade page atau Livewire page sesuai kebutuhan server state. Letakkan business logic, query, authorization, dan validasi di lapisan aplikasi, bukan di komponen UI.

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
