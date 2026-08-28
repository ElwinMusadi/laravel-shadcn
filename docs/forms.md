# Forms

Semua form primitive memakai elemen HTML native dan token semantik. Susun label, input, deskripsi, serta error secara eksplisit agar relasi aksesibilitas dapat dibaca jelas.

## Field dan Field Group

<code>x-ui.field</code> adalah wrapper form dengan <code>orientation="vertical"</code> secara default atau <code>orientation="horizontal"</code>. Prop <code>invalid</code> dan <code>disabled</code>, atau atribut <code>data-invalid</code> dan <code>data-disabled</code>, menghasilkan state pada wrapper.

<code>x-ui.field-group</code> mengelompokkan field secara vertikal. <code>x-ui.field.description</code> menyajikan bantuan. <code>x-ui.field.error</code> menerima <code>name</code> untuk mengambil error bag atau <code>message</code> untuk pesan eksplisit; ia hanya merender saat memiliki pesan atau isi slot.

~~~blade
<x-ui.field :invalid="$errors->has('email')">
    <x-ui.label for="email" required>Email address</x-ui.label>
    <x-ui.input
        id="email"
        name="email"
        type="email"
        wire:model.live="email"
        :invalid="$errors->has('email')"
        :aria-describedby="$errors->has('email') ? 'email-error' : null"
    />
    <x-ui.field.description>We use this to contact you.</x-ui.field.description>
    <x-ui.field.error id="email-error" name="email" />
</x-ui.field>
~~~

## Label

<code>x-ui.label</code> meneruskan <code>for</code>. Prop <code>required</code> menampilkan indikator visual dan teks screen-reader; prop <code>disabled</code> menambahkan <code>aria-disabled</code> serta gaya disabled. Tetapkan <code>id</code> input dan <code>for</code> yang sama pada label.

## Input, Textarea, dan Select

<code>x-ui.input</code>, <code>x-ui.textarea</code>, dan <code>x-ui.select</code> menerima atribut native caller serta prop <code>invalid</code>. Saat invalid, komponen mengeluarkan <code>aria-invalid="true"</code>.

- Input default ke <code>type="text"</code>, tetapi type pemanggil menang.
- Textarea default ke <code>rows="4"</code>; isi slot menjadi nilai awal.
- Select menerima prop <code>placeholder</code>. Placeholder hanya dirender untuk select tunggal; select multiple tidak menerima option placeholder otomatis.

~~~blade
<x-ui.textarea
    id="notes"
    name="notes"
    rows="6"
    wire:model.blur="notes"
>Initial note</x-ui.textarea>

<x-ui.select name="role" placeholder="Choose a role" wire:model="role">
    <option value="admin">Admin</option>
    <option value="member">Member</option>
</x-ui.select>
~~~

## Checkbox, Radio Group, dan Switch

<code>x-ui.checkbox</code> adalah checkbox native. <code>x-ui.switch</code> adalah checkbox native dengan <code>role="switch"</code>, dan mendukung <code>checked</code>, <code>disabled</code>, serta <code>invalid</code>. Hubungkan label switch dengan <code>for</code> ke <code>id</code> input.

<code>x-ui.radio-group</code> merender <code>fieldset</code>, dengan prop <code>label</code>, <code>description</code>, <code>invalid</code>, dan <code>disabled</code>. Anak <code>x-ui.radio-group.option</code> memerlukan <code>name</code> dan <code>value</code>, serta mendukung <code>id</code>, <code>checked</code>, <code>disabled</code>, <code>description</code>, dan <code>invalid</code>.

~~~blade
<x-ui.radio-group label="Density" description="Choose a layout density.">
    <x-ui.radio-group.option name="density" value="comfortable" checked>
        Comfortable
    </x-ui.radio-group.option>
    <x-ui.radio-group.option name="density" value="compact">
        Compact
    </x-ui.radio-group.option>
</x-ui.radio-group>
~~~

## Livewire dan validasi

Karena atribut caller diteruskan, gunakan directive Livewire pada kontrol native yang tepat, misalnya <code>wire:model</code>, <code>wire:model.live</code>, <code>wire:model.blur</code>, <code>wire:click</code>, atau <code>wire:submit</code>. Contoh Profile settings menggunakan <code>wire:model</code> dan <code>wire:submit</code>; gunakan modifier hanya jika kebutuhan state Livewire mengharuskannya.

Livewire memegang validasi server. Setelah memvalidasi, pass status error ke wrapper dan input, lalu hubungkan error menggunakan <code>aria-describedby</code> bila error dirender:

~~~blade
<form wire:submit="updateProfileInformation">
    <x-ui.field :invalid="$errors->has('name')">
        <x-ui.label for="profile-name" required>Name</x-ui.label>
        <x-ui.input
            id="profile-name"
            wire:model="name"
            :invalid="$errors->has('name')"
            :aria-describedby="$errors->has('name') ? 'profile-name-error' : null"
        />
        <x-ui.field.error id="profile-name-error" name="name" />
    </x-ui.field>
    <x-ui.button type="submit">Save</x-ui.button>
</form>
~~~

Gunakan state <code>disabled</code> native atau atribut <code>wire:loading.attr="disabled"</code> untuk mencegah aksi ganda. Jangan membuat state server baru di primitive form generik.
