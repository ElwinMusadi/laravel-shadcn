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

test('authenticated users can visit the internal component showcase', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.components'));

    $response
        ->assertOk()
        ->assertSee('Core UI Components')
        ->assertSee('Button')
        ->assertSee('Avatar, Skeleton, dan Typography');
});
