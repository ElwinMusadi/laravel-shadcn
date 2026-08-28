# Interactions

Komponen interaksi menggunakan state Alpine lokal. Wrapper luar menjaga atribut pemanggil; state internal berada pada elemen anak. Tidak ada Alpine store global.

## Dialog

<code>x-ui.dialog</code> menerima <code>id</code> opsional dan <code>open</code>. Susun dengan <code>trigger</code>, <code>content</code>, <code>header</code>, <code>title</code>, <code>description</code>, <code>footer</code>, dan <code>close</code>.

~~~blade
<x-ui.dialog id="profile-dialog">
    <x-ui.dialog.trigger>Open profile</x-ui.dialog.trigger>
    <x-ui.dialog.content>
        <x-ui.dialog.header>
            <x-ui.dialog.title>Update profile</x-ui.dialog.title>
            <x-ui.dialog.description>Update your details.</x-ui.dialog.description>
        </x-ui.dialog.header>
        <x-ui.dialog.footer>
            <x-ui.dialog.close />
        </x-ui.dialog.footer>
    </x-ui.dialog.content>
</x-ui.dialog>
~~~

Dialog memakai backdrop, <code>role="dialog"</code>, <code>aria-modal</code>, Escape, fokus awal, focus trap ringan, dan pengembalian fokus ke trigger. Untuk membukanya dari action Livewire, dispatch event browser <code>dialog-open</code> dengan detail <code>{ id, trigger? }</code>. Saat menutup, komponen memancarkan <code>dialog-closed</code> dengan ID dialog.

## Sheet

<code>x-ui.sheet</code> memiliki struktur subkomponen yang setara dengan Dialog. <code>x-ui.sheet.content</code> menerima <code>side</code>: <code>top</code>, <code>right</code>, <code>bottom</code>, atau <code>left</code>. Ia mempunyai backdrop, Escape, fokus awal, focus trap ringan, dan pengembalian fokus.

Sheet dipakai oleh header sebagai drawer navigasi seluler. Tidak ada positioning engine eksternal.

## Dropdown

<code>x-ui.dropdown</code> menerima <code>id</code> dan <code>open</code>. Susun dengan <code>trigger</code>, <code>content</code>, <code>group</code>, <code>label</code>, <code>item</code>, serta <code>separator</code>. Content menerima <code>align="start"</code> atau <code>align="end"</code>. Item mendukung <code>href</code>, <code>disabled</code>, dan <code>type</code>.

~~~blade
<x-ui.dropdown id="account-menu">
    <x-ui.dropdown.trigger>Account</x-ui.dropdown.trigger>
    <x-ui.dropdown.content align="end">
        <x-ui.dropdown.group>
            <x-ui.dropdown.item href="{{ route('profile.edit') }}" wire:navigate>
                Settings
            </x-ui.dropdown.item>
        </x-ui.dropdown.group>
    </x-ui.dropdown.content>
</x-ui.dropdown>
~~~

Trigger mendukung Arrow Up/Down dan Escape. Menu item mendukung Arrow Up/Down, Home, End, dan Escape. Menu tertutup oleh klik di luar. Posisi hanya start/end pada anchor lokal; collision detection dinamis tidak tersedia.

## Popover dan Tooltip

<code>x-ui.popover</code> terdiri dari <code>trigger</code> dan <code>content</code>. Content menerima <code>align="start"</code> atau <code>align="end"</code> dan <code>label</code>. Trigger membuka dengan klik atau Arrow Down, dan Content menutup dengan Escape. Posisi anchor lokal tidak memiliki collision detection.

<code>x-ui.tooltip</code> terdiri dari <code>trigger</code> dan <code>content</code>. Trigger membuka pada hover atau focus dan mendukung <code>variant</code>, <code>size</code>, serta <code>disabled</code>. Tooltip adalah bantuan singkat, bukan overlay interaktif.

## Collapsible

<code>x-ui.collapsible</code> menerima <code>id</code> dan <code>defaultOpen</code>. Gunakan <code>trigger</code> dan <code>content</code>. Trigger memperbarui <code>aria-expanded</code>; Content merupakan <code>role="region"</code>. State tidak dipersistenkan.

## Command

Command melakukan filter string pada klien. Susun <code>x-ui.command</code> dengan <code>input</code>, <code>empty</code>, <code>list</code>, <code>group</code>, dan <code>item</code>. Item memerlukan <code>value</code>; ia dapat menerima <code>keywords</code>, <code>href</code>, dan <code>disabled</code>.

~~~blade
<x-ui.command id="workspace-command">
    <x-ui.command.input placeholder="Search commands" />
    <x-ui.command.empty>No command found.</x-ui.command.empty>
    <x-ui.command.list>
        <x-ui.command.group heading="Actions">
            <x-ui.command.item value="Create workspace" keywords="new">
                Create workspace
            </x-ui.command.item>
        </x-ui.command.group>
    </x-ui.command.list>
</x-ui.command>
~~~

Arrow Up/Down mengubah item aktif, Enter memilihnya, dan Escape mengosongkan query lalu memancarkan <code>command-close</code>. Komponen tidak menyediakan pencarian server, command palette global, atau virtualisasi.

## Tabs

<code>x-ui.tabs</code> menerima <code>id</code> dan <code>default</code>, lalu membungkus <code>list</code>, <code>trigger</code>, dan <code>content</code>. Trigger dan Content memakai <code>value</code> yang sama. Trigger juga mendukung <code>disabled</code>.

Arrow Left/Right, Home, dan End mengikuti tab yang tidak disabled. State tab bersifat lokal Alpine dan tidak terikat ke route atau state Livewire secara otomatis.

## Aksesibilitas dan batas

Komponen menyediakan markup ARIA serta keyboard yang dicakup secara representatif oleh Browser test. Focus trap Dialog dan Sheet bersifat ringan; tetap lakukan verifikasi manual dengan keyboard dan pembaca layar pada flow penting. Lihat [Accessibility](accessibility.md) dan [Testing](testing.md).
