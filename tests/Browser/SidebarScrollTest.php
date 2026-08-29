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

test('keeps mobile Sheet navigation scrollable while its header and profile remain accessible', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit('/dashboard')->resize(390, 844);

    $page
        ->click('[aria-label="Open navigation"]')
        ->assertVisible('[role="dialog"]');

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

    $page->assertNoJavaScriptErrors();
});
