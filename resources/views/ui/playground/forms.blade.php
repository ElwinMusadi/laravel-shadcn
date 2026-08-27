<x-playground.layout
    :title="__('Forms')"
    :description="__('Komposisi field menggunakan elemen native agar atribut HTML, Livewire, dan Alpine tetap diteruskan.')"
    current="forms"
>
    <section class="flex flex-col gap-4" aria-labelledby="field-heading">
        <div class="flex flex-col gap-1">
            <x-ui.heading id="field-heading" variant="section">Field, Label, Input, dan Textarea</x-ui.heading>
            <x-ui.heading variant="description">{{ __('Gunakan x-ui.field-group untuk susunan vertikal dan x-ui.field untuk hubungan label, control, description, serta error.') }}</x-ui.heading>
        </div>

        <x-ui.card>
            <x-ui.card.content class="pt-6">
                <form class="grid gap-6 lg:grid-cols-2" aria-label="{{ __('Form component preview') }}" onsubmit="return false">
                    <x-ui.field-group>
                        <x-ui.field>
                            <x-ui.label for="playground-name" required>Name</x-ui.label>
                            <x-ui.input id="playground-name" name="name" autocomplete="name" placeholder="Your name" required />
                            <x-ui.field.description>Nama ini dapat digunakan pada profil pengguna.</x-ui.field.description>
                        </x-ui.field>

                        <x-ui.field invalid>
                            <x-ui.label for="playground-email" required>Email</x-ui.label>
                            <x-ui.input id="playground-email" name="email" type="email" value="invalid-email" invalid aria-describedby="playground-email-error" />
                            <x-ui.field.error id="playground-email-error" message="Masukkan alamat email yang valid." />
                        </x-ui.field>

                        <x-ui.field disabled>
                            <x-ui.label for="playground-disabled" disabled>Disabled input</x-ui.label>
                            <x-ui.input id="playground-disabled" value="Unavailable" disabled />
                        </x-ui.field>
                    </x-ui.field-group>

                    <x-ui.field-group>
                        <x-ui.field>
                            <x-ui.label for="playground-bio">Bio</x-ui.label>
                            <x-ui.textarea id="playground-bio" name="bio" maxlength="500" placeholder="Tell us about yourself."></x-ui.textarea>
                            <x-ui.field.description>Textarea native default ke empat baris dan dapat di-resize vertikal.</x-ui.field.description>
                        </x-ui.field>

                        <x-ui.field>
                            <x-ui.label for="playground-role" required>Role</x-ui.label>
                            <x-ui.select id="playground-role" name="role" placeholder="Select a role" required>
                                <option value="member">Member</option>
                                <option value="admin">Administrator</option>
                            </x-ui.select>
                        </x-ui.field>

                        <x-ui.field invalid>
                            <x-ui.label for="playground-region">Region</x-ui.label>
                            <x-ui.select id="playground-region" name="region" placeholder="Select a region" invalid aria-describedby="playground-region-error">
                                <option value="">No region</option>
                            </x-ui.select>
                            <x-ui.field.error id="playground-region-error">Pilih region sebelum melanjutkan.</x-ui.field.error>
                        </x-ui.field>
                    </x-ui.field-group>
                </form>
            </x-ui.card.content>
        </x-ui.card>

        <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
<x-ui.field :invalid="$errors->has('email')">
    <x-ui.label for="email" required>Email</x-ui.label>
    <x-ui.input id="email" type="email" :invalid="$errors->has('email')" />
    <x-ui.field.error name="email" />
</x-ui.field>
@endverbatim</code></pre>
    </section>

    <section class="grid gap-6 xl:grid-cols-2" aria-labelledby="native-controls-heading">
        <div class="flex flex-col gap-4">
            <x-ui.heading id="native-controls-heading" variant="section">Checkbox dan Switch</x-ui.heading>
            <x-ui.card>
                <x-ui.card.content class="flex flex-col gap-5 pt-6">
                    <x-ui.field orientation="horizontal">
                        <x-ui.checkbox id="playground-terms" name="terms" required />
                        <div class="flex flex-col gap-1">
                            <x-ui.label for="playground-terms">Accept terms and conditions</x-ui.label>
                            <x-ui.field.description>Checkbox adalah control native dengan state required.</x-ui.field.description>
                        </div>
                    </x-ui.field>
                    <x-ui.field orientation="horizontal" class="items-center justify-between">
                        <div class="flex flex-col gap-1"><x-ui.label for="playground-notifications">Enable notifications</x-ui.label><x-ui.field.description>Switch tetap memakai checkbox native dengan role switch.</x-ui.field.description></div>
                        <x-ui.switch id="playground-notifications" name="notifications" checked />
                    </x-ui.field>
                    <x-ui.field orientation="horizontal" class="items-center justify-between" disabled>
                        <div class="flex flex-col gap-1"><x-ui.label for="playground-notifications-disabled" disabled>Disabled switch</x-ui.label><x-ui.field.description>State disabled tetap terlihat.</x-ui.field.description></div>
                        <x-ui.switch id="playground-notifications-disabled" disabled />
                    </x-ui.field>
                </x-ui.card.content>
            </x-ui.card>
        </div>

        <div class="flex flex-col gap-4">
            <x-ui.heading variant="section">Radio Group</x-ui.heading>
            <x-ui.card>
                <x-ui.card.content class="pt-6">
                    <x-ui.radio-group label="Density" description="Pilih satu level density dengan fieldset native.">
                        <x-ui.radio-group.option name="playground-density" value="comfortable" checked>Comfortable</x-ui.radio-group.option>
                        <x-ui.radio-group.option name="playground-density" value="compact" description="Tampilkan lebih banyak konten dalam ruang yang sama.">Compact</x-ui.radio-group.option>
                        <x-ui.radio-group.option name="playground-density" value="unavailable" disabled>Unavailable</x-ui.radio-group.option>
                    </x-ui.radio-group>
                </x-ui.card.content>
            </x-ui.card>
        </div>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="form-api-heading">
        <x-ui.heading id="form-api-heading" variant="section">{{ __('API dan compatibility') }}</x-ui.heading>
        <x-ui.alert>
            <x-ui.alert.title>{{ __('Atribut diteruskan') }}</x-ui.alert.title>
            <x-ui.alert.description>{{ __('Input, Textarea, Select, Checkbox, Radio Group option, dan Switch meneruskan atribut native serta wire:* atau x-* dari pemanggil. Playground tidak mengikatnya ke state server.') }}</x-ui.alert.description>
        </x-ui.alert>
    </section>
</x-playground.layout>
