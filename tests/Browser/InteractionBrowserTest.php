<?php

use App\Models\User;

test('manages focus and keyboard interaction for representative overlay components', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('ui.playground.interaction'));

    $page
        ->click('Open dialog')
        ->assertVisible('[role="dialog"][aria-labelledby="playground-dialog-title"]')
        ->assertSee('Update profile')
        ->assertScript('document.activeElement.getAttribute("aria-label")', 'Close dialog')
        ->keys('[role="dialog"][aria-labelledby="playground-dialog-title"]', 'Escape')
        ->assertMissing('[role="dialog"][aria-labelledby="playground-dialog-title"]')
        ->assertScript('document.activeElement.textContent.includes("Open dialog")', true)
        ->keys('Open menu', 'ArrowDown')
        ->wait(0.3)
        ->assertVisible('[role="menu"][id="playground-dropdown-menu"]')
        ->assertScript('document.activeElement.getAttribute("role")', 'menuitem')
        ->keys('View details', 'ArrowDown')
        ->wait(0.3)
        ->assertScript('document.activeElement.textContent.trim()', 'Copy reference')
        ->keys('Copy reference', 'Escape')
        ->assertMissing('[role="menu"][id="playground-dropdown-menu"]')
        ->keys('Open menu', 'ArrowUp')
        ->wait(0.3)
        ->assertVisible('[role="menu"][id="playground-dropdown-menu"]')
        ->assertScript('document.activeElement.textContent.trim()', 'Copy reference')
        ->keys('Copy reference', 'Escape')
        ->assertMissing('[role="menu"][id="playground-dropdown-menu"]')
        ->click('Open popover')
        ->assertVisible('[role="dialog"][aria-label="Project information"]')
        ->keys('[role="dialog"][aria-label="Project information"]', 'Escape')
        ->assertMissing('[role="dialog"][aria-label="Project information"]')
        ->click('[aria-label="More information"]')
        ->assertVisible('#playground-tooltip [role="tooltip"]')
        ->keys('[aria-controls="playground-collapsible-content"]', 'Enter')
        ->assertAttribute('[aria-controls="playground-collapsible-content"]', 'aria-expanded', 'true')
        ->assertSee('State open disimpan lokal')
        ->assertNoJavaScriptErrors();
});

test('filters command items and completes keyboard selection', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('ui.playground.interaction'));

    $page
        ->type('input[type="search"]', 'archive')
        ->assertVisible('div[role="status"]')
        ->assertSee('No matching command.')
        ->clear('input[type="search"]')
        ->type('input[type="search"]', 'create')
        ->keys('input[type="search"]', 'ArrowDown')
        ->assertScript('document.activeElement.textContent.trim()', 'Create workspace')
        ->keys('input[type="search"]', 'Enter')
        ->assertNoJavaScriptErrors();
});

test('operates representative native form controls', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('ui.playground.forms'));

    $page
        ->assertSee('Field, Label, Input, dan Textarea')
        ->type('playground-name', 'Taylor Otwell')
        ->assertValue('playground-name', 'Taylor Otwell')
        ->select('playground-role', 'admin')
        ->assertSelected('playground-role', 'admin')
        ->check('playground-terms')
        ->assertChecked('playground-terms')
        ->radio('playground-density', 'compact')
        ->assertRadioSelected('playground-density', 'compact')
        ->assertChecked('playground-notifications')
        ->keys('playground-notifications', 'Space')
        ->assertNotChecked('playground-notifications')
        ->assertDisabled('playground-notifications-disabled')
        ->assertNoJavaScriptErrors()
        ->assertNoAccessibilityIssues(1)
        ->click('[aria-label="Switch to dark mode"]')
        ->assertScript('document.documentElement.classList.contains("dark")', true);
});
