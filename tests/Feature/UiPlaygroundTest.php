<?php

use App\Models\User;

test('guests are redirected from the UI Playground to the login page', function () {
    $response = $this->get(route('ui.playground'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can open the canonical UI Playground overview', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.playground'));

    $response
        ->assertSee('Living design system')
        ->assertSee('UI Playground sections', false)
        ->assertSee('Foundations')
        ->assertSee('Components')
        ->assertSee('Authentication')
        ->assertSee('data-test="theme-toggle"', false)
        ->assertDontSee('System', false);
});

test('each UI Playground category renders its documented production composition', function (string $routeName, string $heading) {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route($routeName));

    $response
        ->assertSee($heading)
        ->assertSee('UI Playground sections', false)
        ->assertSee('data-test="theme-toggle"', false);
})->with([
    'foundations' => ['ui.playground.foundations', 'Colors / Tokens'],
    'core components' => ['ui.components', 'Button'],
    'forms' => ['ui.playground.forms', 'Radio Group'],
    'data display' => ['ui.playground.data-display', 'Recent invoices'],
    'navigation' => ['ui.playground.navigation', 'Breadcrumb'],
    'interaction' => ['ui.playground.interaction', 'Command'],
    'application' => ['ui.playground.application', 'Application composition'],
    'blocks' => ['ui.playground.blocks', 'Dashboard-01'],
    'authentication' => ['ui.playground.authentication', 'Password Field'],
]);
