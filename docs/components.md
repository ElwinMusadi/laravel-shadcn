# Components

## Prinsip komponen

Komponen di <code>resources/views/components/ui/</code> adalah primitive visual generik. Gunakan namespace <code>x-ui.*</code>, teruskan atribut native, Livewire, atau Alpine yang relevan, dan jangan masukkan query database, autentikasi, business logic, atau asumsi navigasi aplikasi ke primitive ini.

Komponen di <code>resources/views/components/app/</code> adalah komposisi reusable milik aplikasi. Komponen autentikasi berada di <code>resources/views/components/auth/</code>; Fortify tetap memiliki kontrak backendnya.

## Core UI

### Button

<code>x-ui.button</code> merender elemen <code>button</code>. Variannya adalah <code>default</code>, <code>secondary</code>, <code>destructive</code>, <code>outline</code>, <code>ghost</code>, dan <code>link</code>. Ukuran yang tersedia adalah <code>sm</code>, <code>default</code>, <code>lg</code>, dan <code>icon</code>. Default type adalah <code>button</code>; tetapkan <code>type="submit"</code> untuk form.

~~~blade
<x-ui.button variant="destructive" size="lg" type="submit">
    Delete account
</x-ui.button>
~~~

State native seperti <code>disabled</code>, atribut <code>wire:*</code>, <code>x-*</code>, ARIA, dan atribut form diteruskan ke button.

### Icon

<code>x-ui.icon</code> adalah standar ikon aplikasi yang kompatibel dengan Lucide. Komponen ini menyediakan subset lokal Blade-native dari SVG Lucide yang dipakai shell dan Dashboard-01, sehingga tidak ada package React atau runtime icon library. Berikan <code>name</code>, class ukuran, dan bila perlu <code>stroke-width</code>.

~~~blade
<x-ui.icon name="panel-left" class="size-4" />
<x-ui.icon name="trending-up" class="size-4 text-primary" />
~~~

### Card

<code>x-ui.card</code> adalah container surface. Susun isinya dengan <code>x-ui.card.header</code>, <code>x-ui.card.title</code>, <code>x-ui.card.description</code>, <code>x-ui.card.content</code>, dan <code>x-ui.card.footer</code>.

~~~blade
<x-ui.card>
    <x-ui.card.header>
        <x-ui.card.title>Profile</x-ui.card.title>
        <x-ui.card.description>Manage your public details.</x-ui.card.description>
    </x-ui.card.header>
    <x-ui.card.content>...</x-ui.card.content>
    <x-ui.card.footer>...</x-ui.card.footer>
</x-ui.card>
~~~

### Badge

<code>x-ui.badge</code> mendukung variant <code>default</code>, <code>secondary</code>, <code>destructive</code>, dan <code>outline</code>.

~~~blade
<x-ui.badge variant="secondary">In review</x-ui.badge>
~~~

### Alert

<code>x-ui.alert</code> memiliki variant <code>default</code> dan <code>destructive</code>, serta selalu memakai <code>role="alert"</code>. Slot bernama <code>icon</code> bersifat opsional. Gunakan <code>x-ui.alert.title</code> dan <code>x-ui.alert.description</code> untuk struktur teks.

~~~blade
<x-ui.alert variant="destructive">
    <x-slot:icon>!</x-slot:icon>
    <x-ui.alert.title>Payment failed</x-ui.alert.title>
    <x-ui.alert.description>Try another payment method.</x-ui.alert.description>
</x-ui.alert>
~~~

### Avatar dan Skeleton

<code>x-ui.avatar</code> membungkus <code>x-ui.avatar.image</code> dan <code>x-ui.avatar.fallback</code>. Image menerima <code>src</code> dan <code>alt</code>; fallback tetap terlihat saat image gagal dimuat.

~~~blade
<x-ui.avatar>
    <x-ui.avatar.image src="/avatars/taylor.png" alt="Taylor Otwell" />
    <x-ui.avatar.fallback>TO</x-ui.avatar.fallback>
</x-ui.avatar>
~~~

<code>x-ui.skeleton</code> adalah placeholder dekoratif dengan <code>aria-hidden="true"</code>. Berikan ukuran melalui class pemanggil.

~~~blade
<x-ui.skeleton class="h-4 w-32" />
~~~

### Separator dan Heading

<code>x-ui.separator</code> menerima <code>orientation="horizontal"</code> atau <code>orientation="vertical"</code>. Separator bersifat dekoratif secara default; gunakan <code>:decorative="false"</code> bila pembaca layar perlu mengetahui pemisahnya.

<code>x-ui.heading</code> mendukung variant <code>page</code>, <code>section</code>, <code>subsection</code>, dan <code>description</code>. Prop <code>as</code> hanya menerima <code>h1</code> sampai <code>h6</code> atau <code>p</code>.

~~~blade
<x-ui.heading variant="page">Dashboard</x-ui.heading>
<x-ui.heading variant="description">Workspace overview.</x-ui.heading>
~~~

## Navigation dan data

Primitive navigasi dan data tersedia sebagai <code>Breadcrumb</code>, <code>Tabs</code>, <code>Table</code>, dan <code>Pagination</code>. Detail API dan batas presentasionalnya ada pada [Interactions](interactions.md#tabs) serta [Layouts & Pages](layouts-and-pages.md#navigation-dan-data).

## Komponen aplikasi

| Komponen | Tanggung jawab |
| --- | --- |
| <code>x-app.shell</code> | Shell aplikasi, data nav/workspace default, sidebar desktop, header, main landmark, toast, dan <code>@livewireScripts</code>. |
| <code>x-app.header</code> | Header 48px, trigger sidebar desktop/mobile, konteks halaman, dan theme toggle. |
| <code>x-app.page-container</code> | Gutter, spacing vertikal, dan alignment responsif untuk satu halaman aplikasi di dalam main scroll region. |
| <code>x-app.sidebar</code> | Sidebar Dashboard-01 desktop atau mobile, workspace switcher, navigasi, dan user menu. |
| <code>x-app.navigation</code> | Grup navigasi Dashboard-01, active route, ikon Lucide-compatible, dan <code>wire:navigate</code> untuk route aplikasi. |
| <code>x-app.workspace-switcher</code> | Pemilih workspace demo dalam Dropdown lokal. |
| <code>x-app.brand</code> | Tautan brand menuju dashboard. |
| <code>x-app.user-menu</code> | Identitas user, link Settings, serta form logout POST dengan CSRF. |
| <code>x-app.page-header</code> | Title, description, dan slot <code>actions</code>; breadcrumb tetap milik header aplikasi. |
| <code>x-app.theme-controller</code> | Bootstrap dan factory tema Light/Dark pada root. |
| <code>x-app.theme-toggle</code> | Toggle tema dengan tooltip dan status aksesibel. |
| <code>x-app.toast</code> | Region toast persistent yang mendengar event <code>toast</code>. |

<code>x-app.shell</code> menerima <code>title</code>, <code>description</code>, <code>breadcrumbs</code>, <code>showPageHeader</code>, <code>navigation</code>, dan <code>workspaces</code>.

~~~blade
<x-layouts::app
    :title="__('Orders')"
    :description="__('Recent orders')"
    :breadcrumbs="[['label' => __('Dashboard'), 'route' => 'dashboard'], ['label' => __('Orders')]]"
    :show-page-header="true"
>
    ...
</x-layouts::app>
~~~

Untuk struktur shell Dashboard-01, lihat [Layouts & Pages](layouts-and-pages.md#application-shell) dan [Blocks](blocks.md).

## Komponen autentikasi

<code>x-auth.password-field</code> menyatukan label, input password, toggle tampil/sembunyi Alpine, tautan bantuan opsional, dan error. Prop yang tersedia adalah <code>id</code>, <code>name</code>, <code>label</code>, <code>autocomplete</code>, <code>required</code>, <code>autofocus</code>, <code>invalid</code>, <code>error</code>, <code>helpUrl</code>, dan <code>helpLabel</code>.

~~~blade
<x-auth.password-field
    id="password"
    autocomplete="current-password"
    :invalid="$errors->has('password')"
    :error="$errors->first('password')"
/>
~~~

Komponen ini memiliki presentation layer saja. Route, session, validasi, limiter, dan credential authentication tetap dikelola Fortify. Lihat [Authentication](authentication.md).
