<?php

use App\Models\User;

test('header heights align visually and main header remains persistent on scroll', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit('/dashboard')->resize(1440, 900);

    $sidebarHeight = $page->script('document.querySelector(\'[data-test="application-sidebar-header"]\').getBoundingClientRect().height');
    $mainHeight = $page->script('document.querySelector(\'[data-test="application-header"]\').getBoundingClientRect().height');

    expect($sidebarHeight)->toBe($mainHeight);

    $sidebarBottom = $page->script('document.querySelector(\'[data-test="application-sidebar-header"]\').getBoundingClientRect().bottom');
    $mainBottom = $page->script('document.querySelector(\'[data-test="application-header"]\').getBoundingClientRect().bottom');

    expect($sidebarBottom)->toBe($mainBottom);

    // Scroll test
    $initialMainHeaderTop = $page->script('document.querySelector(\'[data-test="application-header"]\').getBoundingClientRect().top');

    $page->script('document.querySelector(\'[data-test="application-main"]\').scrollTop = 500');

    $scrolledMainHeaderTop = $page->script('document.querySelector(\'[data-test="application-header"]\').getBoundingClientRect().top');

    expect($scrolledMainHeaderTop)->toBe($initialMainHeaderTop);
});
