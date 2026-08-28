# Livewire & Alpine

## Batas tanggung jawab

| Lapisan | Gunakan untuk |
| --- | --- |
| Livewire | State server, business interaction, authorization, validasi server, dan redirect. |
| Alpine | State UI lokal dan sementara, keyboard, focus, filter Command, overlay, dan toggle tema. |
| Blade | Komposisi, markup semantik, slot, dan presentasi. |

Alpine bukan pengganti backend. Jangan menyimpan business state atau aturan keamanan hanya pada browser.

## Atribut Livewire

Primitive form dan button meneruskan atribut pemanggil ke elemen native yang sesuai. Ini memungkinkan penggunaan <code>wire:model</code>, <code>wire:model.live</code>, <code>wire:model.blur</code>, <code>wire:click</code>, <code>wire:submit</code>, <code>wire:loading.attr</code>, dan <code>wire:navigate</code> tanpa API component baru.

~~~blade
<form wire:submit="updatePassword">
    <x-auth.password-field
        id="current-password"
        name="current_password"
        wire:model="current_password"
    />
    <x-ui.button type="submit" wire:loading.attr="disabled">
        Save
    </x-ui.button>
</form>
~~~

Gunakan <code>wire:navigate</code> pada navigasi aplikasi bila halaman tujuan serta lifecycle Livewire sesuai. Theme controller sudah menerapkan ulang class root selama event <code>livewire:navigating</code>.

## Alpine lokal

Komponen berikut memiliki Alpine internal:

- Dialog, Sheet, Dropdown, Popover, Tooltip, Collapsible, Command, dan Tabs.
- Theme controller dan theme toggle.
- Sidebar collapse, workspace switcher, Dashboard-01 chart range.
- Password visibility, two-factor challenge, recovery-code visibility, dan passkey UI.

Jangan menimpa state internal seperti <code>open</code> atau <code>active</code> dari luar kecuali API component memang menyediakan event/atribut yang sesuai. Atribut caller dipertahankan pada wrapper luar agar <code>wire:*</code> dan <code>x-data</code> caller tidak berbenturan.

## Event lintas batas

Toast mendengar event browser <code>toast</code>. Dari Livewire, event aktualnya berbentuk:

~~~php
$this->dispatch('toast', variant: 'success', text: __('Profile updated.'));
~~~

Dialog dapat dibuka dari action Livewire dengan event <code>dialog-open</code> ber-detail ID dialog. Saat menutup, ia memancarkan <code>dialog-closed</code> agar state Livewire dapat dibersihkan bila diperlukan.

## Praktik aman

1. Letakkan data otoritatif di Livewire atau Laravel.
2. Validasi dan authorize setiap aksi server.
3. Pakai <code>wire:key</code> pada loop Livewire yang berubah.
4. Pakai <code>wire:loading</code> atau disabled saat aksi lambat.
5. Pertahankan label, ARIA, dan fokus saat menambah Alpine.
6. Tambahkan Browser test untuk interaksi JavaScript penting.

Lihat [Forms](forms.md), [Interactions](interactions.md), dan [Testing](testing.md).
