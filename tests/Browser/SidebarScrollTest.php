<?php

use App\Models\User;

test('keeps desktop sidebar navigation independently scrollable while its header and footer remain stationary', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit('/dashboard')->resize(1440, 900);

    $page->script('
        const navigation = document.querySelector(\'[data-test="application-sidebar-content"] ul\');
        const items = document.createDocumentFragment();

        for (let index = 0; index < 50; index++) {
            const item = document.createElement("li");

            item.textContent = "Temporary navigation item " + index;
            item.style.height = "40px";
            items.appendChild(item);
        }

        navigation.appendChild(items);
    ');

    $scrollHeight = $page->script('document.querySelector(\'[data-test="application-sidebar-content"]\').scrollHeight');
    $clientHeight = $page->script('document.querySelector(\'[data-test="application-sidebar-content"]\').clientHeight');
    $initialHeaderTop = $page->script('document.querySelector(\'[data-test="application-sidebar-header"]\').getBoundingClientRect().top');
    $initialFooterTop = $page->script('document.querySelector(\'[data-test="application-sidebar-footer"]\').getBoundingClientRect().top');

    $page->script('document.querySelector(\'[data-test="application-sidebar-content"]\').scrollTop = 500');

    expect($scrollHeight)->toBeGreaterThan($clientHeight);
    expect($page->script('document.querySelector(\'[data-test="application-sidebar-content"]\').scrollTop'))->toBeGreaterThan(0);
    expect($page->script('document.querySelector(\'[data-test="application-sidebar-header"]\').getBoundingClientRect().top'))->toBe($initialHeaderTop);
    expect($page->script('document.querySelector(\'[data-test="application-sidebar-footer"]\').getBoundingClientRect().top'))->toBe($initialFooterTop);
    expect($page->script('document.documentElement.scrollHeight <= document.documentElement.clientHeight'))->toBeTrue();

    $page->assertNoJavaScriptErrors();
});

test('renders the mobile Sheet sidebar without Dashboard content and keeps its navigation scrollable', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit('/dashboard')->resize(390, 844);

    $page
        ->click('[aria-label="Open navigation"]')
        ->assertVisible('[role="dialog"]')
        ->assertVisible('[data-test="application-sidebar-mobile"]')
        ->assertVisible('[data-test="application-navigation-mobile"] [data-test="sidebar-quick-create"]')
        ->assertMissing('[data-test="application-navigation-mobile"] [data-test="sidebar-inbox"]');

    expect($page->script('(() => {
        const sheet = document.querySelector(\'[role="dialog"]\');
        const sidebar = document.querySelector(\'[data-test="application-sidebar-mobile"]\');
        const dashboard = document.querySelector(\'[data-test="dashboard-01"]\');
        const overlay = sheet.parentElement;
        const sheetRect = sheet.getBoundingClientRect();
        const sidebarRect = sidebar.getBoundingClientRect();
        const sheetStyle = getComputedStyle(sheet);

        return sheet.contains(sidebar)
            && ! sheet.contains(dashboard)
            && sheetRect.top === 0
            && sheetRect.bottom === window.innerHeight
            && sidebarRect.height > 0
            && sheetStyle.backgroundColor !== "rgba(0, 0, 0, 0)"
            && sheetStyle.overflowY === "auto"
            && overlay.contains(document.elementFromPoint(window.innerWidth - 8, 300))
            && sheetRect.left <= 0
            && sheetRect.right <= window.innerWidth;
    })()'))->toBeTrue();

    expect($page->script('(() => {
        const sheet = document.querySelector(\'[role="dialog"]\');
        const backdrop = sheet.previousElementSibling;
        const sheetStyle = getComputedStyle(sheet);
        const backdropStyle = getComputedStyle(backdrop);

        return sheet.dataset.state === "open"
            && sheetStyle.transitionProperty.includes("transform")
            && sheetStyle.transitionDuration.includes("0.2s")
            && sheetStyle.transitionTimingFunction.includes("linear")
            && backdropStyle.transitionProperty.includes("opacity")
            && backdropStyle.transitionDuration.includes("0.2s")
            && backdropStyle.transitionTimingFunction.includes("linear");
    })()'))->toBeTrue();

    $page->script('
        const navigation = document.querySelector(\'[data-test="application-sidebar-mobile-content"] ul\');
        const items = document.createDocumentFragment();

        for (let index = 0; index < 50; index++) {
            const item = document.createElement("li");

            item.textContent = "Temporary navigation item " + index;
            item.style.height = "40px";
            items.appendChild(item);
        }

        navigation.appendChild(items);
    ');

    $scrollHeight = $page->script('document.querySelector(\'[data-test="application-sidebar-mobile-content"]\').scrollHeight');
    $clientHeight = $page->script('document.querySelector(\'[data-test="application-sidebar-mobile-content"]\').clientHeight');
    $initialHeaderTop = $page->script('document.querySelector(\'[data-test="application-sidebar-mobile-header"]\').getBoundingClientRect().top');
    $initialFooterTop = $page->script('document.querySelector(\'[data-test="application-sidebar-mobile-footer"]\').getBoundingClientRect().top');

    $page->script('document.querySelector(\'[data-test="application-sidebar-mobile-content"]\').scrollTop = 500');

    expect($scrollHeight)->toBeGreaterThan($clientHeight);
    expect($page->script('document.querySelector(\'[data-test="application-sidebar-mobile-content"]\').scrollTop'))->toBeGreaterThan(0);
    expect($page->script('document.querySelector(\'[data-test="application-sidebar-mobile-header"]\').getBoundingClientRect().top'))->toBe($initialHeaderTop);
    expect($page->script('document.querySelector(\'[data-test="application-sidebar-mobile-footer"]\').getBoundingClientRect().top'))->toBe($initialFooterTop);
    expect($page->script('document.documentElement.scrollHeight <= document.documentElement.clientHeight'))->toBeTrue();
    expect($page->script('document.documentElement.scrollWidth <= document.documentElement.clientWidth'))->toBeTrue();

    $page
        ->keys('[role="dialog"]', 'Escape')
        ->assertMissing('[role="dialog"]')
        ->assertScript('document.activeElement.dataset.test', 'application-navigation-trigger')
        ->click('[aria-label="Open navigation"]')
        ->assertVisible('[data-test="application-sidebar-mobile"]');

    $page
        ->keys('[role="dialog"]', 'Escape')
        ->assertMissing('[role="dialog"]')
        ->resize(768, 900)
        ->click('[aria-label="Open navigation"]')
        ->assertVisible('[data-test="application-sidebar-mobile"]')
        ->assertVisible('[data-test="application-navigation-mobile"] [data-test="sidebar-quick-create"]');

    expect($page->script('(() => {
        const sheet = document.querySelector(\'[role="dialog"]\');
        const sidebar = document.querySelector(\'[data-test="application-sidebar-mobile"]\');
        const sheetRect = sheet.getBoundingClientRect();

        return sheet.contains(sidebar)
            && sheetRect.top === 0
            && sheetRect.bottom === window.innerHeight
            && sidebar.getBoundingClientRect().height > 0
            && document.documentElement.scrollWidth <= document.documentElement.clientWidth
            && document.documentElement.scrollHeight <= document.documentElement.clientHeight;
    })()'))->toBeTrue();

    $page->assertNoJavaScriptErrors();
});

test('renders the mobile Sheet sidebar after Livewire navigation returns to Dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit('/dashboard')->resize(390, 844);

    $page
        ->click('[aria-label="Open navigation"]')
        ->assertVisible('[data-test="application-navigation-mobile"]');

    $page->script('document.querySelector(\'[data-test="application-navigation-mobile"] [data-test="sidebar-navigation-item-data-library"]\').dispatchEvent(new MouseEvent("click", { bubbles: true, cancelable: true }))');

    $page
        ->assertPathIs('/ui')
        ->click('[aria-label="Open navigation"]')
        ->assertVisible('[data-test="application-navigation-mobile"]');

    $page->script('document.querySelector(\'[data-test="application-navigation-mobile"] [data-test="sidebar-navigation-item-dashboard"]\').dispatchEvent(new MouseEvent("click", { bubbles: true, cancelable: true }))');

    $page
        ->assertPathIs('/dashboard')
        ->click('[aria-label="Open navigation"]')
        ->assertVisible('[data-test="application-sidebar-mobile"]');

    expect($page->script('(() => {
        const sheet = document.querySelector(\'[role="dialog"]\');
        const sidebar = document.querySelector(\'[data-test="application-sidebar-mobile"]\');
        const dashboard = document.querySelector(\'[data-test="dashboard-01"]\');

        return sheet.contains(sidebar)
            && ! sheet.contains(dashboard)
            && sidebar.getBoundingClientRect().height > 0;
    })()'))->toBeTrue();

    $page->assertNoJavaScriptErrors();
});
