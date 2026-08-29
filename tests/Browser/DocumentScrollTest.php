<?php

use App\Models\User;

test('keeps Dashboard scrolling inside the application main region on desktop', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit('/dashboard')->resize(1440, 900);
    $mainScrollHeight = $page->script('document.querySelector(\'[data-test="application-main"]\').scrollHeight');
    $mainClientHeight = $page->script('document.querySelector(\'[data-test="application-main"]\').clientHeight');
    $initialHeaderTop = $page->script('document.querySelector(\'[data-test="application-header"]\').getBoundingClientRect().top');

    $page->script('document.querySelector(\'[data-test="application-main"]\').scrollTop = 500');

    expect($mainScrollHeight)->toBeGreaterThan($mainClientHeight);
    expect($page->script('document.querySelector(\'[data-test="application-main"]\').scrollTop'))->toBeGreaterThan(0);
    expect($page->script('document.querySelector(\'[data-test="application-header"]\').getBoundingClientRect().top'))->toBe($initialHeaderTop);
    expect($page->script('window.scrollY'))->toBe(0);
    expect($page->script('document.documentElement.scrollTop'))->toBe(0);
    expect($page->script('document.body.scrollTop'))->toBe(0);
    expect($page->script('document.documentElement.scrollHeight <= document.documentElement.clientHeight'))->toBeTrue();

    $page->assertNoJavaScriptErrors();
});

test('keeps the application shell bounded without horizontal document overflow at every layout breakpoint', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit('/dashboard');

    foreach ([[1440, 900], [1024, 900], [768, 900], [390, 844]] as [$width, $height]) {
        $page->resize($width, $height);

        expect($page->script('document.documentElement.scrollHeight <= document.documentElement.clientHeight'))->toBeTrue();
        expect($page->script('document.documentElement.scrollWidth <= document.documentElement.clientWidth'))->toBeTrue();
        expect($page->script('document.querySelector(\'[data-test="application-main"]\').scrollHeight > document.querySelector(\'[data-test="application-main"]\').clientHeight'))->toBeTrue();
    }

    $page->assertNoJavaScriptErrors();
});
