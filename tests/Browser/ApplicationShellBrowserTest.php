<?php

use App\Models\User;

test('supports desktop sidebar collapse and the Ctrl+B keyboard shortcut', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->visit(route('dashboard'))
        ->resize(1440, 900)
        ->assertVisible('aside[data-test="application-sidebar"]')
        ->click('[aria-label="Collapse sidebar"]')
        ->assertVisible('[aria-label="Expand sidebar"]')
        ->keys('[aria-label="Expand sidebar"]', 'Control+B')
        ->assertVisible('[aria-label="Collapse sidebar"]')
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
        ->resize(390, 844)
        ->assertVisible('[aria-label="Open navigation"]')
        ->assertScript('Array.from(document.querySelectorAll("aside[aria-label=\'Application sidebar\']")).some((element) => element.getClientRects().length > 0)', false)
        ->keys('[aria-label="Open navigation"]', 'Enter')
        ->assertVisible('[role="dialog"]')
        ->assertSee('Navigation')
        ->keys('[role="dialog"]', 'Escape')
        ->assertMissing('[role="dialog"]')
        ->click('Last 7 days')
        ->assertAttribute('[aria-controls="dashboard-chart-7d"]', 'aria-pressed', 'true')
        ->assertVisible('#dashboard-chart-7d')
        ->click('[aria-label="Open actions for Project brief"]')
        ->assertVisible('[role="menu"][id="dashboard-row-actions-1-menu"]')
        ->assertSee('Preview item')
        ->keys('[role="menu"][id="dashboard-row-actions-1-menu"]', 'Escape')
        ->assertMissing('[role="menu"][id="dashboard-row-actions-1-menu"]')
        ->assertScript('document.documentElement.scrollWidth <= window.innerWidth', true)
        ->assertNoJavaScriptErrors()
        ->assertNoAccessibilityIssues(1);
});
