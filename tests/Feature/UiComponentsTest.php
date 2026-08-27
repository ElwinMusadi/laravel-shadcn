<?php

use App\Models\User;

test('button renders variants, sizes, and caller attributes', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.button variant="destructive" size="lg" type="submit" name="action" value="delete" form="delete-user" wire:click="deleteUser" wire:loading.attr="disabled" wire:target="deleteUser" x-on:click="open = true" x-bind:disabled="isBusy">
            Delete account
        </x-ui.button>
        <x-ui.button size="sm">Small</x-ui.button>
        <x-ui.button size="icon" aria-label="Add item">+</x-ui.button>
        BLADE);

    $view
        ->assertSee('bg-destructive', false)
        ->assertSee('h-10', false)
        ->assertSee('h-8', false)
        ->assertSee('size-9', false)
        ->assertSee('type="submit"', false)
        ->assertSee('name="action"', false)
        ->assertSee('value="delete"', false)
        ->assertSee('form="delete-user"', false)
        ->assertSee('wire:click="deleteUser"', false)
        ->assertSee('wire:loading.attr="disabled"', false)
        ->assertSee('wire:target="deleteUser"', false)
        ->assertSee('x-on:click="open = true"', false)
        ->assertSee('x-bind:disabled="isBusy"', false)
        ->assertSee('aria-label="Add item"', false);
});

test('button preserves the disabled state and focus treatment', function () {
    $view = $this->blade('<x-ui.button disabled>Saving</x-ui.button>');

    $view
        ->assertSee('disabled', false)
        ->assertSee('disabled:pointer-events-none', false)
        ->assertSee('focus-visible:ring-2', false);
});

test('card renders its composable sections with semantic tokens', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.card data-component="profile-card">
            <x-ui.card.header>
                <x-ui.card.title>Profile</x-ui.card.title>
                <x-ui.card.description>Manage your profile.</x-ui.card.description>
            </x-ui.card.header>
            <x-ui.card.content>Content</x-ui.card.content>
            <x-ui.card.footer>Footer</x-ui.card.footer>
        </x-ui.card>
        BLADE);

    $view
        ->assertSee('data-component="profile-card"', false)
        ->assertSee('bg-card', false)
        ->assertSee('text-card-foreground', false)
        ->assertSee('border-border', false)
        ->assertSee('Profile')
        ->assertSee('Manage your profile.')
        ->assertSee('Content')
        ->assertSee('Footer');
});

test('badge renders its supported variants and caller attributes', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.badge data-status="one">Default</x-ui.badge>
        <x-ui.badge variant="secondary">Secondary</x-ui.badge>
        <x-ui.badge variant="destructive">Destructive</x-ui.badge>
        <x-ui.badge variant="outline">Outline</x-ui.badge>
        BLADE);

    $view
        ->assertSee('data-status="one"', false)
        ->assertSee('bg-primary', false)
        ->assertSee('bg-secondary', false)
        ->assertSee('bg-destructive', false)
        ->assertSee('border-border', false);
});

test('separator renders decorative and semantic orientations', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.separator />
        <x-ui.separator orientation="vertical" :decorative="false" data-section="menu" />
        BLADE);

    $view
        ->assertSee('aria-hidden="true"', false)
        ->assertSee('h-px w-full bg-border', false)
        ->assertSee('role="separator"', false)
        ->assertSee('aria-orientation="vertical"', false)
        ->assertSee('h-full w-px shrink-0 bg-border', false)
        ->assertSee('data-section="menu"', false);
});

test('alert renders a title, description, icon slot, and destructive variant', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.alert variant="destructive" data-alert="billing">
            <x-slot:icon><span>!</span></x-slot:icon>
            <x-ui.alert.title>Payment failed</x-ui.alert.title>
            <x-ui.alert.description>Try another payment method.</x-ui.alert.description>
        </x-ui.alert>
        BLADE);

    $view
        ->assertSee('role="alert"', false)
        ->assertSee('data-alert="billing"', false)
        ->assertSee('border-destructive/50', false)
        ->assertSee('text-destructive', false)
        ->assertSee('Payment failed')
        ->assertSee('Try another payment method.')
        ->assertSee('aria-hidden="true"', false);
});

test('avatar renders an accessible image with a fallback for unavailable images', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.avatar data-avatar="example">
            <x-ui.avatar.image src="/missing-avatar.png" alt="Taylor Otwell" />
            <x-ui.avatar.fallback>TO</x-ui.avatar.fallback>
        </x-ui.avatar>
        BLADE);

    $view
        ->assertSee('data-avatar="example"', false)
        ->assertSee('src="/missing-avatar.png"', false)
        ->assertSee('alt="Taylor Otwell"', false)
        ->assertSee('onerror="this.classList.add(&#039;hidden&#039;)"', false)
        ->assertSee('TO')
        ->assertSee('bg-muted', false);
});

test('skeleton is hidden from assistive technology and uses semantic tokens', function () {
    $view = $this->blade('<x-ui.skeleton class="h-4 w-32" data-loading="content" />');

    $view
        ->assertSee('aria-hidden="true"', false)
        ->assertSee('animate-pulse', false)
        ->assertSee('bg-muted', false)
        ->assertSee('data-loading="content"', false);
});

test('heading preserves page, section, and description semantics', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.heading variant="page">Page title</x-ui.heading>
        <x-ui.heading variant="section">Section title</x-ui.heading>
        <x-ui.heading variant="description">Supporting text</x-ui.heading>
        BLADE);

    $view
        ->assertSee('<h1', false)
        ->assertSee('<h2', false)
        ->assertSee('<p', false)
        ->assertSee('text-foreground', false)
        ->assertSee('text-muted-foreground', false)
        ->assertSee('Page title')
        ->assertSee('Section title')
        ->assertSee('Supporting text');
});

test('field composes labels, descriptions, and error messages', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.field invalid data-field="email">
            <x-ui.label for="email" required>Email</x-ui.label>
            <x-ui.input id="email" invalid />
            <x-ui.field.description>We use this to contact you.</x-ui.field.description>
            <x-ui.field.error message="A valid email address is required." />
        </x-ui.field>
        BLADE);

    $view
        ->assertSee('data-field="email"', false)
        ->assertSee('data-invalid', false)
        ->assertSee('for="email"', false)
        ->assertSee('aria-invalid="true"', false)
        ->assertSee('required', false)
        ->assertSee('We use this to contact you.')
        ->assertSee('A valid email address is required.')
        ->assertSee('role="alert"', false);
});

test('input and textarea preserve native, Livewire, and Alpine attributes', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.input type="email" name="email" autocomplete="email" required readonly min="1" max="10" step="1" pattern=".+@.+" wire:model.live="form.email" x-model="email" />
        <x-ui.textarea name="notes" rows="6" maxlength="500" minlength="3" required disabled wire:model.blur="form.notes" x-model="notes">Initial note</x-ui.textarea>
        BLADE);

    $view
        ->assertSee('type="email"', false)
        ->assertSee('autocomplete="email"', false)
        ->assertSee('readonly', false)
        ->assertSee('pattern=".+@.+"', false)
        ->assertSee('wire:model.live="form.email"', false)
        ->assertSee('x-model="email"', false)
        ->assertSee('rows="6"', false)
        ->assertSee('maxlength="500"', false)
        ->assertSee('wire:model.blur="form.notes"', false)
        ->assertSee('x-model="notes"', false)
        ->assertSee('Initial note');
});

test('select renders placeholder and native option composition', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.select name="status" placeholder="Choose status" required wire:model.change="status">
            <option value="">No selection</option>
        </x-ui.select>
        <x-ui.select name="published-status" placeholder="Choose published status">
            <optgroup label="Availability">
                <option value="active" selected>Active</option>
            </optgroup>
        </x-ui.select>
        BLADE);

    $view
        ->assertSee('<select', false)
        ->assertSee('name="status"', false)
        ->assertSee('wire:model.change="status"', false)
        ->assertSee('Choose status')
        ->assertSee('<option value="" disabled selected>Choose status</option>', false)
        ->assertSee('Choose published status')
        ->assertSee('<optgroup label="Availability">', false)
        ->assertSee('<option value="active" selected>', false)
        ->assertSee('border-input', false);
});

test('checkbox and switch preserve checked disabled and model attributes', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.checkbox id="terms" name="terms" value="accepted" checked disabled required wire:model="terms" x-model="terms" />
        <x-ui.switch id="notifications" name="notifications" checked disabled wire:model.live="notifications" x-model="notifications" />
        BLADE);

    $view
        ->assertSee('id="terms"', false)
        ->assertSee('value="accepted"', false)
        ->assertSee('type="checkbox"', false)
        ->assertSee('wire:model="terms"', false)
        ->assertSee('x-model="terms"', false)
        ->assertSee('role="switch"', false)
        ->assertSee('id="notifications"', false)
        ->assertSee('wire:model.live="notifications"', false)
        ->assertSee('peer-checked:bg-primary', false)
        ->assertSee('disabled', false);
});

test('radio group renders native grouping, selected options, and disabled options', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.radio-group label="Layout" description="Choose a density.">
            <x-ui.radio-group.option name="layout" value="comfortable" checked wire:model="layout">Comfortable</x-ui.radio-group.option>
            <x-ui.radio-group.option name="layout" value="compact" disabled description="More content.">Compact</x-ui.radio-group.option>
        </x-ui.radio-group>
        BLADE);

    $view
        ->assertSee('<fieldset', false)
        ->assertSee('<legend', false)
        ->assertSee('Layout')
        ->assertSee('name="layout"', false)
        ->assertSee('value="comfortable"', false)
        ->assertSee('checked', false)
        ->assertSee('wire:model="layout"', false)
        ->assertSee('value="compact"', false)
        ->assertSee('disabled', false)
        ->assertSee('More content.');
});

test('table renders semantic composable sections in a responsive surface', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.table data-table="invoices">
            <x-ui.table.caption>Invoices</x-ui.table.caption>
            <x-ui.table.header><x-ui.table.row><x-ui.table.head>Number</x-ui.table.head></x-ui.table.row></x-ui.table.header>
            <x-ui.table.body><x-ui.table.row><x-ui.table.cell>INV-001</x-ui.table.cell></x-ui.table.row></x-ui.table.body>
            <x-ui.table.footer><x-ui.table.row><x-ui.table.cell>Total</x-ui.table.cell></x-ui.table.row></x-ui.table.footer>
        </x-ui.table>
        BLADE);

    $view
        ->assertSee('overflow-x-auto', false)
        ->assertSee('<table', false)
        ->assertSee('data-table="invoices"', false)
        ->assertSee('<caption', false)
        ->assertSee('<thead', false)
        ->assertSee('<tbody', false)
        ->assertSee('<tfoot', false)
        ->assertSee('<th scope="col"', false)
        ->assertSee('<td', false);
});

test('pagination renders accessible active and disabled controls', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.pagination label="Result pages">
            <x-ui.pagination.item><x-ui.pagination.previous disabled /></x-ui.pagination.item>
            <x-ui.pagination.item><x-ui.pagination.link href="?page=1" active>1</x-ui.pagination.link></x-ui.pagination.item>
            <x-ui.pagination.item><x-ui.pagination.ellipsis /></x-ui.pagination.item>
            <x-ui.pagination.item><x-ui.pagination.next href="?page=2" /></x-ui.pagination.item>
        </x-ui.pagination>
        BLADE);

    $view
        ->assertSee('<nav', false)
        ->assertSee('aria-label="Result pages"', false)
        ->assertSee('aria-disabled="true"', false)
        ->assertSee('aria-current="page"', false)
        ->assertSee('href="?page=2"', false)
        ->assertSee('More pages')
        ->assertSee('<ul', false);
});

test('breadcrumb renders links, separators, and the current page', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.breadcrumb label="Location">
            <x-ui.breadcrumb.item><x-ui.breadcrumb.link href="/">Home</x-ui.breadcrumb.link></x-ui.breadcrumb.item>
            <x-ui.breadcrumb.separator>/</x-ui.breadcrumb.separator>
            <x-ui.breadcrumb.item><x-ui.breadcrumb.page>Settings</x-ui.breadcrumb.page></x-ui.breadcrumb.item>
        </x-ui.breadcrumb>
        BLADE);

    $view
        ->assertSee('aria-label="Location"', false)
        ->assertSee('<ol', false)
        ->assertSee('href="/"', false)
        ->assertSee('aria-current="page"', false)
        ->assertSee('Settings');
});

test('tabs render declarative active state and keyboard interaction semantics', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.tabs id="preferences-tabs" default="profile">
            <x-ui.tabs.list aria-label="Preferences">
                <x-ui.tabs.trigger value="profile">Profile</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="security" disabled>Security</x-ui.tabs.trigger>
            </x-ui.tabs.list>
            <x-ui.tabs.content value="profile">Profile content</x-ui.tabs.content>
            <x-ui.tabs.content value="security">Security content</x-ui.tabs.content>
        </x-ui.tabs>
        BLADE);

    $view
        ->assertSee('x-data=', false)
        ->assertSee('x-ref="list"', false)
        ->assertSee('role="tablist"', false)
        ->assertSee('role="tab"', false)
        ->assertSee('@keydown.right.prevent', false)
        ->assertSee('@keydown.left.prevent', false)
        ->assertSee('role="tabpanel"', false)
        ->assertSee('x-show=', false)
        ->assertSee('data-[state=active]:bg-background', false)
        ->assertSee('disabled', false);
});

test('dialog renders focus-safe modal composition and preserves caller attributes', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.dialog id="profile-dialog" x-data="{ callerState: true }" wire:ignore.self>
            <x-ui.dialog.trigger wire:click="prepareProfile" x-on:click="callerState = false">Open profile</x-ui.dialog.trigger>
            <x-ui.dialog.content data-dialog="profile">
                <x-ui.dialog.close />
                <x-ui.dialog.header>
                    <x-ui.dialog.title>Update profile</x-ui.dialog.title>
                    <x-ui.dialog.description>Update your public information.</x-ui.dialog.description>
                </x-ui.dialog.header>
                <x-ui.dialog.footer><x-ui.button>Save</x-ui.button></x-ui.dialog.footer>
            </x-ui.dialog.content>
        </x-ui.dialog>
        BLADE);

    $view
        ->assertSee('id="profile-dialog"', false)
        ->assertSee('x-data="{ callerState: true }"', false)
        ->assertSee('wire:ignore.self', false)
        ->assertSee('wire:click="prepareProfile"', false)
        ->assertSee('x-on:click="callerState = false"', false)
        ->assertSee('role="dialog"', false)
        ->assertSee('aria-modal="true"', false)
        ->assertSee(':aria-labelledby="`${dialogId}-title`"', false)
        ->assertSee(':aria-describedby="`${dialogId}-description`"', false)
        ->assertSee('x-init=', false)
        ->assertSee('@keydown.escape.stop.prevent', false)
        ->assertSee('@keydown.tab=', false)
        ->assertSee('bg-card', false)
        ->assertSee('text-card-foreground', false)
        ->assertSee('max-h-[calc(100dvh-2rem)]', false);
});

test('sheet renders directional modal panels with focus and responsive safeguards', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.sheet id="left-sheet">
            <x-ui.sheet.trigger>Open left sheet</x-ui.sheet.trigger>
            <x-ui.sheet.content side="left">
                <x-ui.sheet.header>
                    <x-ui.sheet.title>Left panel</x-ui.sheet.title>
                    <x-ui.sheet.description>Supplementary content.</x-ui.sheet.description>
                </x-ui.sheet.header>
            </x-ui.sheet.content>
        </x-ui.sheet>
        <x-ui.sheet id="bottom-sheet">
            <x-ui.sheet.trigger variant="outline">Open bottom sheet</x-ui.sheet.trigger>
            <x-ui.sheet.content side="bottom"><x-ui.sheet.title>Bottom panel</x-ui.sheet.title></x-ui.sheet.content>
        </x-ui.sheet>
        BLADE);

    $view
        ->assertSee('role="dialog"', false)
        ->assertSee(':aria-labelledby="`${sheetId}-title`"', false)
        ->assertSee('aria-modal="true"', false)
        ->assertSee('@keydown.escape.stop.prevent', false)
        ->assertSee('@keydown.tab=', false)
        ->assertSee('left-0', false)
        ->assertSee('bottom-0', false)
        ->assertSee('max-w-[calc(100vw-2rem)]', false)
        ->assertSee('max-h-[calc(100dvh-2rem)]', false)
        ->assertSee('bg-card', false);
});

test('dropdown renders native link and button items with keyboard navigation', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.dropdown id="account-menu" x-data="{ callerOpen: false }">
            <x-ui.dropdown.trigger wire:click="trackMenu">Account</x-ui.dropdown.trigger>
            <x-ui.dropdown.content align="start" data-menu="account">
                <x-ui.dropdown.group>
                    <x-ui.dropdown.label>Account</x-ui.dropdown.label>
                    <x-ui.dropdown.item href="/profile">Profile</x-ui.dropdown.item>
                    <x-ui.dropdown.item wire:click="openBilling">Billing</x-ui.dropdown.item>
                </x-ui.dropdown.group>
                <x-ui.dropdown.separator />
                <x-ui.dropdown.item disabled>Unavailable</x-ui.dropdown.item>
            </x-ui.dropdown.content>
        </x-ui.dropdown>
        BLADE);

    $view
        ->assertSee('x-data="{ callerOpen: false }"', false)
        ->assertSee('wire:click="trackMenu"', false)
        ->assertSee('wire:click="openBilling"', false)
        ->assertSee('role="menu"', false)
        ->assertSee('role="menuitem"', false)
        ->assertSee('href="/profile"', false)
        ->assertSee('aria-disabled="true"', false)
        ->assertSee('role="separator"', false)
        ->assertSee('@keydown.down.prevent', false)
        ->assertSee('@keydown.up.prevent', false)
        ->assertSee('@keydown.home.prevent', false)
        ->assertSee('@keydown.end.prevent', false)
        ->assertSee('@keydown.escape.stop.prevent', false)
        ->assertSee('bg-popover', false)
        ->assertSee('text-popover-foreground', false);
});

test('popover renders an anchored interactive surface with dismissal controls', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.popover id="help-popover" wire:ignore>
            <x-ui.popover.trigger x-on:click="helpOpened = true">Help</x-ui.popover.trigger>
            <x-ui.popover.content align="end" label="Help information" data-popover="help">
                <x-ui.input autofocus wire:model="help.query" />
            </x-ui.popover.content>
        </x-ui.popover>
        BLADE);

    $view
        ->assertSee('wire:ignore', false)
        ->assertSee('x-on:click="helpOpened = true"', false)
        ->assertSee('role="dialog"', false)
        ->assertSee('aria-modal="false"', false)
        ->assertSee('aria-label="Help information"', false)
        ->assertSee('@click.outside="open = false"', false)
        ->assertSee('@keydown.escape.stop.prevent', false)
        ->assertSee('right-0', false)
        ->assertSee('max-w-[calc(100vw-2rem)]', false)
        ->assertSee('wire:model="help.query"', false)
        ->assertSee('bg-popover', false);
});

test('tooltip renders focus and hover behavior for enabled and disabled button triggers', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.tooltip id="help-tooltip">
            <x-ui.tooltip.trigger aria-label="Help" wire:click="showHelp">?</x-ui.tooltip.trigger>
            <x-ui.tooltip.content>Open the help center.</x-ui.tooltip.content>
        </x-ui.tooltip>
        <x-ui.tooltip id="disabled-tooltip">
            <x-ui.tooltip.trigger disabled aria-label="Unavailable">?</x-ui.tooltip.trigger>
            <x-ui.tooltip.content>This action is unavailable.</x-ui.tooltip.content>
        </x-ui.tooltip>
        BLADE);

    $view
        ->assertSee('wire:click="showHelp"', false)
        ->assertSee('@mouseenter="open = true"', false)
        ->assertSee('@mouseleave="open = false"', false)
        ->assertSee('@focusin="open = true"', false)
        ->assertSee('@focusout="open = false"', false)
        ->assertSee('x-bind:aria-describedby="`${tooltipId}-description`"', false)
        ->assertSee('role="tooltip"', false)
        ->assertSee('class="sr-only"', false)
        ->assertSee('disabled="disabled"', false)
        ->assertSee('bg-foreground', false)
        ->assertSee('text-background', false);
});

test('collapsible renders default state and linked trigger content semantics', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.collapsible id="details" default-open x-data="{ callerState: true }" wire:ignore>
            <x-ui.collapsible.trigger wire:click="trackDetails">Details</x-ui.collapsible.trigger>
            <x-ui.collapsible.content data-content="details">More information.</x-ui.collapsible.content>
        </x-ui.collapsible>
        BLADE);

    $view
        ->assertSee('x-data="{ callerState: true }"', false)
        ->assertSee('wire:ignore', false)
        ->assertSee('open: true', false)
        ->assertSee('wire:click="trackDetails"', false)
        ->assertSee('x-bind:id="`${collapsibleId}-trigger`"', false)
        ->assertSee('x-bind:aria-expanded="open"', false)
        ->assertSee('x-bind:aria-controls="`${collapsibleId}-content`"', false)
        ->assertSee('role="region"', false)
        ->assertSee(':aria-labelledby="`${collapsibleId}-trigger`"', false)
        ->assertSee('x-show="open"', false)
        ->assertSee('x-transition.opacity', false);
});

test('command renders client-side search, grouped results, keyboard selection, and empty state', function () {
    $view = $this->blade(<<<'BLADE'
        <x-ui.command id="app-command" x-data="{ callerState: true }" wire:ignore>
            <x-ui.command.input placeholder="Search commands" wire:model.live="query" />
            <x-ui.command.empty>No command found.</x-ui.command.empty>
            <x-ui.command.list>
                <x-ui.command.group heading="Actions">
                    <x-ui.command.item value="Create project" keywords="new workspace" wire:click="createProject">Create project</x-ui.command.item>
                    <x-ui.command.item value="Profile" href="/profile">Profile</x-ui.command.item>
                    <x-ui.command.item value="Disabled" disabled>Disabled command</x-ui.command.item>
                </x-ui.command.group>
            </x-ui.command.list>
        </x-ui.command>
        BLADE);

    $view
        ->assertSee('x-data="{ callerState: true }"', false)
        ->assertSee('wire:ignore', false)
        ->assertSee("query: ''", false)
        ->assertSee('x-model="query"', false)
        ->assertSee('wire:model.live="query"', false)
        ->assertSee('x-ref="list"', false)
        ->assertSee('role="list"', false)
        ->assertSee('data-command-item', false)
        ->assertSee('data-command-value="create project new workspace"', false)
        ->assertSee('wire:click="createProject"', false)
        ->assertSee('href="/profile"', false)
        ->assertSee('data-disabled', false)
        ->assertSee('role="status"', false)
        ->assertSee('@keydown.down.prevent', false)
        ->assertSee('@keydown.up.prevent', false)
        ->assertSee('@keydown.enter.prevent', false)
        ->assertSee('@keydown.escape=', false)
        ->assertSee('data-[active=true]:bg-accent', false)
        ->assertSee('bg-popover', false);
});

test('authenticated users can visit the internal component showcase', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.components'));

    $response
        ->assertOk()
        ->assertSee('UI Components')
        ->assertSee('Button')
        ->assertSee('Avatar, Skeleton, dan Typography')
        ->assertSee('Forms')
        ->assertSee('Data')
        ->assertSee('Navigation')
        ->assertSee('Dialog')
        ->assertSee('Sheet')
        ->assertSee('Dropdown Menu')
        ->assertSee('Popover & Tooltip')
        ->assertSee('Collapsible')
        ->assertSee('Command');
});
