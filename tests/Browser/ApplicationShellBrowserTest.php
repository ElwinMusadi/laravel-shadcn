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

    $page = $this->visit(route('dashboard'));

    foreach ([[1024, 900], [1440, 900]] as [$width, $height]) {
        $page
            ->resize($width, $height)
            ->assertVisible('aside[data-test="application-sidebar"]')
            ->assertVisible('[data-test="application-navigation-desktop"] [data-test="sidebar-quick-create"]')
            ->assertMissing('[data-test="application-navigation-desktop"] [data-test="sidebar-inbox"]')
            ->assertScript('(() => {
            const sidebar = document.querySelector(\'aside[data-test="application-sidebar"]\');
            const shell = document.querySelector(\'[data-test="application-shell"]\');
            const sidebarStyle = getComputedStyle(sidebar);
            const shellStyle = getComputedStyle(shell);

            return sidebar.dataset.state === "open"
                && sidebarStyle.transitionProperty.includes("width")
                && sidebarStyle.transitionProperty.includes("transform")
                && sidebarStyle.transitionProperty.includes("opacity")
                && sidebarStyle.transitionDuration.includes("0.2s")
                && sidebarStyle.transitionTimingFunction.includes("linear")
                && shellStyle.transitionProperty.includes("gap")
                && shellStyle.transitionDuration.includes("0.2s");
        })()', true)
            ->click('[aria-label="Toggle sidebar"]')
            ->assertScript('(() => {
            const sidebar = document.querySelector(\'aside[data-test="application-sidebar"]\');

            return sidebar.dataset.state === "closed"
                && sidebar.getAttribute("aria-hidden") === "true"
                && sidebar.hasAttribute("inert");
        })()', true)
            ->keys('[aria-label="Toggle sidebar"]', 'Control+B')
            ->assertScript('(() => {
            const sidebar = document.querySelector(\'aside[data-test="application-sidebar"]\');

            return sidebar.dataset.state === "open"
                && sidebar.getAttribute("aria-hidden") === "false"
                && ! sidebar.hasAttribute("inert");
        })()', true)
            ->assertNoJavaScriptErrors();
    }
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

test('keeps the Dashboard pagination controls aligned at desktop and mobile widths', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('dashboard'));

    foreach ([[390, 844], [1024, 900], [1440, 900]] as [$width, $height]) {
        $page
            ->resize($width, $height)
            ->assertVisible('[data-test="dashboard-pagination-footer"]')
            ->assertVisible('#dashboard-rows-per-page')
            ->assertVisible('[data-test="dashboard-pagination"]')
            ->assertScript('(() => {
                const footer = document.querySelector("[data-test=\'dashboard-pagination-footer\']");
                const controls = document.querySelector("[data-test=\'dashboard-pagination-controls\']");
                const label = document.querySelector("label[for=\'dashboard-rows-per-page\']");
                const select = document.querySelector("#dashboard-rows-per-page");
                const pagination = document.querySelector("[data-test=\'dashboard-pagination\']");

                if (! footer || ! controls || ! label || ! select || ! pagination) {
                    return false;
                }

                const footerBounds = footer.getBoundingClientRect();
                const controlsBounds = controls.getBoundingClientRect();
                const labelBounds = label.getBoundingClientRect();
                const selectBounds = select.getBoundingClientRect();
                const paginationBounds = pagination.getBoundingClientRect();

                return labelBounds.height <= 24
                    && Math.abs(
                        (labelBounds.top + (labelBounds.height / 2))
                        - (selectBounds.top + (selectBounds.height / 2)),
                    ) <= 1
                    && controlsBounds.left >= footerBounds.left - 1
                    && controlsBounds.right <= footerBounds.right + 1
                    && paginationBounds.right <= footerBounds.right + 1
                    && document.documentElement.scrollWidth <= window.innerWidth;
            })()', true);
    }

    $page->assertNoJavaScriptErrors();
});
