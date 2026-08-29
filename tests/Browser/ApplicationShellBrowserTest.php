<?php

use App\Models\User;

test('toggles the desktop Dashboard-01 sidebar and supports the Ctrl+B keyboard shortcut', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->visit(route('dashboard'))
        ->resize(1440, 900)
        ->assertVisible('aside[data-test="application-sidebar"]')
        ->assertVisible('[data-test="application-navigation-desktop"] [data-test="sidebar-quick-create"]')
        ->assertVisible('[data-test="application-navigation-desktop"] [data-test="sidebar-inbox"]')
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
