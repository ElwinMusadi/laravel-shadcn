<?php

use App\Models\User;

test('authenticated users receive the Blade native application shell', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertSee('data-test="application-header"', false)
        ->assertSee('aria-label="Primary navigation"', false)
        ->assertSee('data-test="application-navigation-trigger"', false)
        ->assertSee('aria-haspopup="dialog"', false)
        ->assertSee('role="dialog"', false)
        ->assertSee('id="main-content"', false)
        ->assertSee('data-test="application-main"', false)
        ->assertSee('Skip to main content')
        ->assertSee('Dashboard');
});

test('application navigation renders named route links and marks the current page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.components'));

    $response
        ->assertSee('data-test="application-navigation-item-dashboard"', false)
        ->assertSee('href="'.route('ui.components').'"', false)
        ->assertSee('data-test="application-navigation-item-ui-components"', false)
        ->assertSee('aria-current="page"', false);
});

test('page header composes title description breadcrumbs and actions', function () {
    $view = $this->blade(<<<'BLADE'
        <x-app.page-header
            title="Settings"
            description="Manage your account preferences."
            :breadcrumbs="[
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Settings'],
            ]"
        >
            <x-slot:actions>
                <x-ui.button>Save changes</x-ui.button>
            </x-slot:actions>
        </x-app.page-header>
        BLADE);

    $view
        ->assertSee('<h1', false)
        ->assertSee('Settings')
        ->assertSee('Manage your account preferences.')
        ->assertSee('aria-label="Breadcrumb"', false)
        ->assertSee('href="'.route('dashboard').'"', false)
        ->assertSee('aria-current="page"', false)
        ->assertSee('Save changes');
});

test('user menu exposes identity settings and the protected logout form', function () {
    $user = User::factory()->create([
        'name' => 'Taylor Otwell',
        'email' => 'taylor@example.com',
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertSee('data-test="application-user-menu"', false)
        ->assertSee('Taylor Otwell')
        ->assertSee('taylor@example.com')
        ->assertSee('href="'.route('profile.edit').'"', false)
        ->assertSee('data-test="logout-form"', false)
        ->assertSee('method="POST"', false)
        ->assertSee('action="'.route('logout').'"', false)
        ->assertSee('name="_token"', false)
        ->assertSee('type="submit"', false)
        ->assertSee('data-test="logout-button"', false);
});
