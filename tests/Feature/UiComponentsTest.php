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

test('authenticated users can visit the internal component showcase', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.components'));

    $response
        ->assertOk()
        ->assertSee('Core UI Components')
        ->assertSee('Button')
        ->assertSee('Avatar, Skeleton, dan Typography')
        ->assertSee('Forms')
        ->assertSee('Data')
        ->assertSee('Navigation');
});
