<?php

use App\Models\User;

test('authenticated users receive the Blade native sidebar application shell', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertSee('data-test="application-shell"', false)
        ->assertSee('x-data="{ sidebarExpanded: true }"', false)
        ->assertSee('--app-sidebar-expanded', false)
        ->assertSee('--app-sidebar-collapsed', false)
        ->assertSee('data-test="application-sidebar"', false)
        ->assertSee('data-test="application-sidebar-header"', false)
        ->assertSee('data-test="application-sidebar-content"', false)
        ->assertSee('data-test="application-sidebar-footer"', false)
        ->assertSee('data-test="application-sidebar-mobile"', false)
        ->assertSee('data-test="application-sidebar-workspace-switcher"', false)
        ->assertSee('data-test="application-sidebar-mobile-workspace-switcher"', false)
        ->assertSee('data-test="application-header"', false)
        ->assertSee('data-test="application-navigation-desktop"', false)
        ->assertSee('data-test="application-navigation-mobile"', false)
        ->assertSee('data-test="application-sidebar-trigger"', false)
        ->assertSee('data-test="application-navigation-trigger"', false)
        ->assertSee('aria-label="Open navigation"', false)
        ->assertSee('aria-label="Dashboard"', false)
        ->assertSee('!justify-center !px-0', false)
        ->assertSee('aria-haspopup="dialog"', false)
        ->assertSee('aria-haspopup="menu"', false)
        ->assertSee('x-bind:aria-expanded="open"', false)
        ->assertSee('role="dialog"', false)
        ->assertSee('id="main-content"', false)
        ->assertSee('data-test="application-main"', false)
        ->assertSee('Skip to main content')
        ->assertSee('Dashboard');
});

test('sidebar navigation renders grouped named routes and expands an active nested route', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.playground'));

    $response
        ->assertSee('data-test="sidebar-navigation-item-dashboard"', false)
        ->assertSee('href="'.route('ui.playground').'"', false)
        ->assertSee('data-test="sidebar-navigation-item-ui-playground"', false)
        ->assertSee('data-test="sidebar-navigation-group-library"', false)
        ->assertSee('x-data="{ open: true', false)
        ->assertSee('aria-current="page"', false)
        ->assertSee('wire:navigate', false);
});

test('sidebar renders custom navigation data in both desktop and mobile compositions', function () {
    $view = $this->blade(<<<'BLADE'
        <x-app.shell
            :navigation="[
                [
                    'key' => 'shared',
                    'label' => 'Shared group',
                    'items' => [
                        [
                            'key' => 'shared-entry',
                            'label' => 'Shared navigation entry',
                            'icon' => 'N',
                            'route' => 'dashboard',
                            'active' => ['dashboard'],
                        ],
                    ],
                ],
            ]"
            :workspaces="[
                ['key' => 'demo', 'name' => 'Demo Workspace', 'plan' => 'Demo', 'initials' => 'DW'],
            ]"
        >
            <span>Shell content</span>
        </x-app.shell>
        BLADE);

    $view
        ->assertSee('Shared group')
        ->assertSee('Shared navigation entry')
        ->assertSee('data-test="application-navigation-desktop"', false)
        ->assertSee('data-test="application-navigation-mobile"', false);

    expect(substr_count((string) $view, 'data-test="sidebar-navigation-item-shared-entry"'))->toBe(2);
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

test('sidebar user menu exposes identity settings and the protected logout form', function () {
    $user = User::factory()->create([
        'name' => 'Taylor Otwell',
        'email' => 'taylor@example.com',
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertSee('data-test="application-sidebar-user-menu"', false)
        ->assertSee('data-test="application-sidebar-mobile-user-menu"', false)
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
