<?php

use App\Models\User;

test('uses a normal application brand link to return from the UI Playground to Dashboard on desktop', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('ui.playground'))->resize(1024, 900);

    foreach ([[1024, 900], [1440, 900]] as [$width, $height]) {
        $page
            ->resize($width, $height)
            ->assertVisible('a[data-test="application-sidebar-brand"]')
            ->assertAttribute('a[data-test="application-sidebar-brand"]', 'href', route('dashboard'))
            ->assertAttributeMissing('a[data-test="application-sidebar-brand"]', 'aria-expanded')
            ->assertAttributeMissing('a[data-test="application-sidebar-brand"]', 'aria-haspopup')
            ->assertMissing('[data-test="application-sidebar-workspace-switcher"]');
    }

    $page
        ->click('a[data-test="application-sidebar-brand"]')
        ->assertPathIs('/dashboard')
        ->assertAttribute('[data-test="application-navigation-desktop"] [data-test="sidebar-navigation-item-dashboard"]', 'aria-current', 'page')
        ->assertVisible('[data-test="application-sidebar-footer"]')
        ->assertNoJavaScriptErrors();

    $this->visit(route('ui.playground'))
        ->resize(1440, 900)
        ->keys('a[data-test="application-sidebar-brand"]', 'Enter')
        ->assertPathIs('/dashboard')
        ->assertNoJavaScriptErrors();
});

test('keeps the mobile application brand a normal dashboard link without a workspace menu', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('ui.playground'));

    foreach ([[390, 844], [768, 900]] as [$width, $height]) {
        $page
            ->resize($width, $height)
            ->click('[aria-label="Open navigation"]')
            ->assertVisible('a[data-test="application-sidebar-mobile-brand"]')
            ->assertAttribute('a[data-test="application-sidebar-mobile-brand"]', 'href', route('dashboard'))
            ->assertAttributeMissing('a[data-test="application-sidebar-mobile-brand"]', 'aria-expanded')
            ->assertAttributeMissing('a[data-test="application-sidebar-mobile-brand"]', 'aria-haspopup')
            ->assertMissing('[data-test="application-sidebar-mobile-workspace-switcher"]')
            ->keys('[role="dialog"]', 'Escape')
            ->assertMissing('[role="dialog"]');
    }

    $page
        ->click('[aria-label="Open navigation"]')
        ->click('a[data-test="application-sidebar-mobile-brand"]')
        ->assertPathIs('/dashboard')
        ->assertVisible('[data-test="dashboard-01"]')
        ->assertNoJavaScriptErrors();
});

test('toggles the desktop Dashboard-01 sidebar and supports the Ctrl+B keyboard shortcut', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->visit(route('dashboard'))
        ->resize(1440, 900)
        ->assertVisible('aside[data-test="application-sidebar"]')
        ->assertVisible('[data-test="application-navigation-desktop"] [data-test="sidebar-quick-create"]')
        ->assertMissing('[data-test="application-navigation-desktop"] [data-test="sidebar-inbox"]')
        ->click('[aria-label="Toggle sidebar"]')
        ->assertScript('document.querySelector(\'aside[data-test="application-sidebar"]\').getClientRects().length > 0', false)
        ->keys('[aria-label="Toggle sidebar"]', 'Control+B')
        ->assertScript('document.querySelector(\'aside[data-test="application-sidebar"]\').getClientRects().length > 0', true)
        ->assertNoJavaScriptErrors();
});

test('keeps the dashboard and navigation usable at tablet and mobile widths', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('dashboard'));

    $page
        ->resize(1024, 900)
        ->assertVisible('aside[data-test="application-sidebar"]')
        ->assertScript('document.documentElement.scrollWidth <= window.innerWidth', true)
        ->click('[role="tab"][data-value="past-performance"]')
        ->assertAttribute('[role="tab"][data-value="past-performance"]', 'aria-selected', 'true')
        ->resize(390, 844)
        ->assertVisible('[aria-label="Open navigation"]')
        ->assertScript('Array.from(document.querySelectorAll("aside[aria-label=\'Application sidebar\']")).some((element) => element.getClientRects().length > 0)', false)
        ->keys('[aria-label="Open navigation"]', 'Enter')
        ->assertVisible('[role="dialog"]')
        ->assertSee('Dashboard')
        ->keys('[role="dialog"]', 'Escape')
        ->assertMissing('[role="dialog"]')
        ->assertScript('document.activeElement.dataset.test', 'application-navigation-trigger')
        ->select('dashboard-chart-range-select', '7d')
        ->assertVisible('#dashboard-chart-7d')
        ->click('[aria-label="Open actions for Cover page"]')
        ->assertVisible('[role="menu"][id="dashboard-row-actions-1-menu"]')
        ->assertSee('Preview section')
        ->keys('[role="menu"][id="dashboard-row-actions-1-menu"]', 'Escape')
        ->assertMissing('[role="menu"][id="dashboard-row-actions-1-menu"]')
        ->assertScript('document.documentElement.scrollWidth <= window.innerWidth', true)
        ->assertNoJavaScriptErrors()
        ->assertNoAccessibilityIssues(1);
});
