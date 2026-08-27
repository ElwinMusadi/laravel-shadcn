<x-playground.layout
    :title="__('Interaction')"
    :description="__('Primitive interaksi memakai state Alpine lokal dari komponen yang sama dengan halaman aplikasi.')"
    current="interaction"
>
    <section class="flex flex-col gap-4" aria-labelledby="dialog-heading">
        <div class="flex flex-col gap-1"><x-ui.heading id="dialog-heading" variant="section">Dialog</x-ui.heading><x-ui.heading variant="description">{{ __('Trigger, title, description, footer, backdrop, Escape, dan focus trap dikelola oleh x-ui.dialog.') }}</x-ui.heading></div>
        <x-ui.card><x-ui.card.content class="flex flex-wrap gap-3 pt-6">
            <x-ui.dialog id="playground-dialog">
                <x-ui.dialog.trigger>Open dialog</x-ui.dialog.trigger>
                <x-ui.dialog.content>
                    <x-ui.dialog.close class="absolute right-4 top-4" />
                    <x-ui.dialog.header><x-ui.dialog.title>Update profile</x-ui.dialog.title><x-ui.dialog.description>Ini adalah preview; perubahan tidak disimpan.</x-ui.dialog.description></x-ui.dialog.header>
                    <div class="px-6 pb-6 text-sm leading-6 text-muted-foreground">Konten dialog dapat menampung form atau detail pemanggil.</div>
                    <x-ui.dialog.footer><x-ui.button variant="outline" @click="open = false">Cancel</x-ui.button><x-ui.button @click="open = false">Continue</x-ui.button></x-ui.dialog.footer>
                </x-ui.dialog.content>
            </x-ui.dialog>
            <x-ui.dialog id="playground-destructive-dialog">
                <x-ui.dialog.trigger variant="destructive">Delete item</x-ui.dialog.trigger>
                <x-ui.dialog.content><x-ui.dialog.close class="absolute right-4 top-4" /><x-ui.dialog.header><x-ui.dialog.title>Delete this item?</x-ui.dialog.title><x-ui.dialog.description>Contoh visual aksi destructive tanpa operasi data.</x-ui.dialog.description></x-ui.dialog.header><x-ui.dialog.footer><x-ui.button variant="outline" @click="open = false">Cancel</x-ui.button><x-ui.button variant="destructive" @click="open = false">Delete</x-ui.button></x-ui.dialog.footer></x-ui.dialog.content>
            </x-ui.dialog>
        </x-ui.card.content></x-ui.card>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="sheet-heading">
        <x-ui.heading id="sheet-heading" variant="section">Sheet</x-ui.heading>
        <x-ui.card><x-ui.card.content class="flex flex-wrap gap-3 pt-6">
            @foreach (['left' => 'Left', 'right' => 'Right', 'top' => 'Top', 'bottom' => 'Bottom'] as $side => $label)
                <x-ui.sheet id="playground-sheet-{{ $side }}">
                    <x-ui.sheet.trigger variant="outline">{{ $label }} sheet</x-ui.sheet.trigger>
                    <x-ui.sheet.content :side="$side"><x-ui.sheet.close class="absolute right-4 top-4" /><x-ui.sheet.header><x-ui.sheet.title>{{ $label }} sheet</x-ui.sheet.title><x-ui.sheet.description>Panel {{ strtolower($label) }} menggunakan ukuran responsif dan fokus aman.</x-ui.sheet.description></x-ui.sheet.header><x-ui.sheet.footer><x-ui.button @click="open = false">Done</x-ui.button></x-ui.sheet.footer></x-ui.sheet.content>
                </x-ui.sheet>
            @endforeach
        </x-ui.card.content></x-ui.card>
    </section>

    <section class="grid gap-6 xl:grid-cols-2" aria-labelledby="menu-heading">
        <div class="flex flex-col gap-4">
            <x-ui.heading id="menu-heading" variant="section">Dropdown Menu</x-ui.heading>
            <x-ui.card><x-ui.card.content class="pt-6">
                <x-ui.dropdown id="playground-dropdown">
                    <x-ui.dropdown.trigger>Open menu</x-ui.dropdown.trigger>
                    <x-ui.dropdown.content align="start"><x-ui.dropdown.group><x-ui.dropdown.label>Actions</x-ui.dropdown.label><x-ui.dropdown.item href="#menu-heading">View details</x-ui.dropdown.item><x-ui.dropdown.item>Copy reference</x-ui.dropdown.item></x-ui.dropdown.group><x-ui.dropdown.separator /><x-ui.dropdown.group><x-ui.dropdown.item disabled>Unavailable</x-ui.dropdown.item></x-ui.dropdown.group></x-ui.dropdown.content>
                </x-ui.dropdown>
            </x-ui.card.content></x-ui.card>
        </div>
        <div class="flex flex-col gap-4">
            <x-ui.heading variant="section">Popover</x-ui.heading>
            <x-ui.card><x-ui.card.content class="pt-6">
                <x-ui.popover id="playground-popover"><x-ui.popover.trigger>Open popover</x-ui.popover.trigger><x-ui.popover.content label="Project information"><div class="flex flex-col gap-2"><p class="text-sm font-medium text-foreground">Project information</p><p class="text-sm leading-6 text-muted-foreground">Anchored content supports focus, Escape, outside click, dan alignment start/end.</p><x-ui.input placeholder="Optional value" /></div></x-ui.popover.content></x-ui.popover>
            </x-ui.card.content></x-ui.card>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-2" aria-labelledby="tooltip-heading">
        <div class="flex flex-col gap-4">
            <x-ui.heading id="tooltip-heading" variant="section">Tooltip</x-ui.heading>
            <x-ui.card><x-ui.card.content class="flex items-center gap-3 pt-6">
                <x-ui.tooltip id="playground-tooltip"><x-ui.tooltip.trigger aria-label="More information">i</x-ui.tooltip.trigger><x-ui.tooltip.content>Hover or focus to read this label.</x-ui.tooltip.content></x-ui.tooltip>
                <x-ui.tooltip id="playground-disabled-tooltip"><x-ui.tooltip.trigger disabled aria-label="Unavailable">?</x-ui.tooltip.trigger><x-ui.tooltip.content>This action is unavailable.</x-ui.tooltip.content></x-ui.tooltip>
            </x-ui.card.content></x-ui.card>
        </div>
        <div class="flex flex-col gap-4">
            <x-ui.heading variant="section">Collapsible</x-ui.heading>
            <x-ui.card><x-ui.card.content class="pt-6">
                <x-ui.collapsible id="playground-collapsible"><x-ui.collapsible.trigger class="w-full justify-between">Show implementation notes <span aria-hidden="true" x-text="open ? '−' : '+'"></span></x-ui.collapsible.trigger><x-ui.collapsible.content><p class="text-sm leading-6 text-muted-foreground">State open disimpan lokal dan relationship trigger/content dipublikasikan dengan ARIA.</p></x-ui.collapsible.content></x-ui.collapsible>
            </x-ui.card.content></x-ui.card>
        </div>
    </section>

    <section class="flex flex-col gap-4" aria-labelledby="command-heading">
        <div class="flex flex-col gap-1"><x-ui.heading id="command-heading" variant="section">Command</x-ui.heading><x-ui.heading variant="description">{{ __('Pencarian dan keyboard navigation bekerja terhadap static local data di DOM, tanpa Fuse.js atau request server.') }}</x-ui.heading></div>
        <x-ui.command id="playground-command">
            <x-ui.command.input placeholder="Search commands" />
            <x-ui.command.empty>No matching command.</x-ui.command.empty>
            <x-ui.command.list>
                <x-ui.command.group heading="Navigation"><x-ui.command.item value="Open dashboard" keywords="home overview" href="{{ route('dashboard') }}" wire:navigate>Open dashboard</x-ui.command.item><x-ui.command.item value="Open playground" keywords="ui components" href="{{ route('ui.playground') }}" wire:navigate>Open playground</x-ui.command.item></x-ui.command.group>
                <x-ui.command.group heading="Actions"><x-ui.command.item value="Create workspace" keywords="new project">Create workspace</x-ui.command.item><x-ui.command.item value="Unavailable action" disabled>Unavailable action</x-ui.command.item></x-ui.command.group>
            </x-ui.command.list>
        </x-ui.command>
        <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
<x-ui.command id="project-command">
    <x-ui.command.input />
    <x-ui.command.list>…</x-ui.command.list>
</x-ui.command>
@endverbatim</code></pre>
    </section>
</x-playground.layout>
