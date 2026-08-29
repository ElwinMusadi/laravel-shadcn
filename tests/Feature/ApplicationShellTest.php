<?php

use App\Models\User;

test('authenticated users receive the Blade native sidebar application shell', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertSee('data-test="application-shell"', false)
        ->assertSee('x-data="{ sidebarExpanded: true }"', false)
        ->assertSee('--app-sidebar-expanded', false)
        ->assertSee('--app-sidebar-gap', false)
        ->assertSee('x-bind:data-sidebar-state="sidebarExpanded ? \'open\' : \'closed\'"', false)
        ->assertSee('data-state="sidebarExpanded ? \'open\' : \'closed\'"', false)
        ->assertSee('x-bind:aria-hidden="(! sidebarExpanded).toString()"', false)
        ->assertSee('x-bind:inert="! sidebarExpanded"', false)
        ->assertSee('lg:transition-[width,transform,opacity]', false)
        ->assertSee('lg:transition-[gap]', false)
        ->assertSee('data-test="application-sidebar"', false)
        ->assertSee('id="application-sidebar"', false)
        ->assertSee('data-test="application-sidebar-header"', false)
        ->assertSee('data-test="application-sidebar-content"', false)
        ->assertSee('data-test="application-sidebar-footer"', false)
        ->assertSee('data-test="application-sidebar-mobile"', false)
        ->assertSee('data-test="application-sidebar-brand"', false)
        ->assertSee('data-test="application-sidebar-mobile-brand"', false)
        ->assertSee('href="'.route('dashboard').'"', false)
        ->assertDontSee('application-sidebar-workspace-switcher', false)
        ->assertDontSee('application-sidebar-mobile-workspace-switcher', false)
        ->assertDontSee('Switch workspace')
        ->assertDontSee('Workspaces')
        ->assertSee('data-test="application-header"', false)
        ->assertSee('data-test="application-navigation-desktop"', false)
        ->assertSee('data-test="application-navigation-mobile"', false)
        ->assertSee('data-test="application-sidebar-trigger"', false)
        ->assertSee('data-test="application-navigation-trigger"', false)
        ->assertSee('aria-label="Open navigation"', false)
        ->assertSee('aria-label="Toggle sidebar"', false)
        ->assertSee('data-test="sidebar-quick-create"', false)
        ->assertDontSee('data-test="sidebar-inbox"', false)
        ->assertSee('data-test="sidebar-navigation-item-data-library"', false)
        ->assertSee('aria-haspopup="dialog"', false)
        ->assertSee('aria-haspopup="menu"', false)
        ->assertSee('x-bind:aria-expanded="open"', false)
        ->assertSee('role="dialog"', false)
        ->assertSee('id="main-content"', false)
        ->assertSee('data-test="application-main"', false)
        ->assertSee('Skip to main content')
        ->assertSee('Documents');
});

test('sidebar navigation renders grouped named routes and expands an active nested route', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.playground'));

    $response
        ->assertSee('data-test="sidebar-navigation-item-dashboard"', false)
        ->assertSee('href="'.route('ui.playground').'"', false)
        ->assertSee('data-test="sidebar-navigation-item-data-library"', false)
        ->assertSee('id="sidebar-group-desktop-documents"', false)
        ->assertSee('Quick Create')
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

test('sidebar application brand is a dashboard link without dropdown semantics', function () {
    $view = $this->blade('<x-app.brand sidebar data-test="application-sidebar-brand" />');

    $view
        ->assertSee('<a', false)
        ->assertSee('data-test="application-sidebar-brand"', false)
        ->assertSee('href="'.route('dashboard').'"', false)
        ->assertSee('wire:navigate', false)
        ->assertSee('flex h-8 w-full min-w-0 items-center', false)
        ->assertSee('focus-visible:ring-2 focus-visible:ring-sidebar-ring', false)
        ->assertSee(config('app.name', 'Laravel'))
        ->assertDontSee('aria-expanded=', false)
        ->assertDontSee('aria-haspopup=', false)
        ->assertDontSee('role="menu"', false)
        ->assertDontSee('Switch workspace')
        ->assertDontSee('Workspaces');
});

test('renders the local Lucide-compatible icon component with caller attributes', function () {
    $view = $this->blade('<x-ui.icon name="panel-left" class="size-4" aria-label="Sidebar icon" />');

    $view
        ->assertSee('<svg', false)
        ->assertSee('viewBox="0 0 24 24"', false)
        ->assertSee('class="shrink-0 size-4"', false)
        ->assertSee('aria-label="Sidebar icon"', false)
        ->assertSee('<rect width="18" height="18" x="3" y="3" rx="2"', false);
});

test('page header composes title description and actions', function () {
    $view = $this->blade(<<<'BLADE'
        <x-app.page-header
            title="Settings"
            description="Manage your account preferences."
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
        ->assertDontSee('aria-label="Breadcrumb"', false)
        ->assertSee('Save changes');
});

test('shell wraps optional page headers in the standard page container', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $view = $this->blade(<<<'BLADE'
        <x-app.shell
            title="Orders"
            description="Recent orders"
            :show-page-header="true"
        >
            <span>Orders content</span>
        </x-app.shell>
        BLADE);

    $view
        ->assertSee('class="box-border flex w-full min-w-0 flex-col gap-6 px-4 py-6 sm:px-6 lg:px-8 lg:py-8"', false)
        ->assertSee('Orders')
        ->assertSee('Recent orders')
        ->assertSee('Orders content');
});

test('header composes breadcrumbs or fallback title', function () {
    $viewWithBreadcrumbs = $this->blade(<<<'BLADE'
        <x-app.header
            :breadcrumbs="[
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Settings'],
            ]"
        />
        BLADE);

    $viewWithBreadcrumbs
        ->assertSee('aria-label="Breadcrumb"', false)
        ->assertSee('href="'.route('dashboard').'"', false)
        ->assertSee('aria-current="page"', false);

    $viewWithTitle = $this->blade('<x-app.header title="Custom Title" />');
    $viewWithTitle
        ->assertDontSee('aria-label="Breadcrumb"', false)
        ->assertSee('Custom Title');
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
