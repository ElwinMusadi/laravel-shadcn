<?php

use App\Models\User;

test('uses light as the default even when the browser prefers dark', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->visit(route('dashboard'))
        ->inDarkMode()
        ->resize(1440, 900)
        ->assertSee('Dashboard')
        ->assertScript('document.documentElement.classList.contains("dark")', false)
        ->assertAttribute('[aria-label="Switch to dark mode"]', 'aria-pressed', 'false')
        ->assertNoJavaScriptErrors();
});

test('persists explicit theme choices through reloads and invalid storage', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('dashboard'));

    $page
        ->click('[aria-label="Switch to dark mode"]')
        ->assertScript('document.documentElement.classList.contains("dark")', true)
        ->assertScript('window.localStorage.getItem("theme")', 'dark')
        ->assertAttribute('[aria-label="Switch to light mode"]', 'aria-pressed', 'true')
        ->refresh()
        ->assertScript('document.documentElement.classList.contains("dark")', true)
        ->click('[aria-label="Switch to light mode"]')
        ->assertScript('document.documentElement.classList.contains("dark")', false)
        ->assertScript('window.localStorage.getItem("theme")', 'light')
        ->refresh()
        ->assertScript('document.documentElement.classList.contains("dark")', false);

    $page->script('window.localStorage.setItem("theme", "system")');

    $page
        ->refresh()
        ->assertScript('document.documentElement.classList.contains("dark")', false)
        ->assertScript('window.localStorage.getItem("theme")', 'system')
        ->assertNoJavaScriptErrors();
});

test('preserves the selected theme across representative Livewire navigation', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('dashboard'));

    $page->script('window.__browserNavigationMarker = "preserved"');

    $page
        ->click('[aria-label="Switch to dark mode"]');

    $page->script('document.querySelector(\'[data-test="sidebar-navigation-item-ui-playground"]\').dispatchEvent(new MouseEvent("click", { bubbles: true, cancelable: true }))');

    $page
        ->wait(1)
        ->assertPathIs('/ui')
        ->assertSee('Living design system')
        ->assertScript('window.__browserNavigationMarker', 'preserved')
        ->assertScript('document.documentElement.classList.contains("dark")', true)
        ->assertScript('window.localStorage.getItem("theme")', 'dark')
        ->assertNoJavaScriptErrors();
});
