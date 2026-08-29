<?php

use App\Models\User;

test('guests are redirected from the UI Playground to the login page', function () {
    $response = $this->get(route('ui.playground'));

    $response->assertRedirect(route('login'));
});

test('guests are redirected from the Input Playground to the login page', function () {
    $response = $this->get(route('ui.components.input'));

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

test('authenticated users can open the Input component playground', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.components.input'));

    $response
        ->assertOk()
        ->assertSee('Input')
        ->assertSee('UI Playground sections', false)
        ->assertSee('↳ Input')
        ->assertSee('Input Group')
        ->assertSee('Button Group')
        ->assertSee('Field')
        ->assertSee('Textarea')
        ->assertSee('Select')
        ->assertSee('Checkbox')
        ->assertSee('Switch')
        ->assertSee('Radio Group')
        ->assertSee('Form Composition');
});

test('Input playground renders all form primitive sections', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('ui.components.input'));

    $response
        ->assertSee('id="input-group-heading"', false)
        ->assertSee('id="button-group-heading"', false)
        ->assertSee('flex items-stretch', false)
        ->assertSee('-space-x-px', false)
        ->assertSee('https://')
        ->assertSee('Left')
        ->assertSee('Account Information');
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
    'input components' => ['ui.components.input', 'Input Group'],
    'forms' => ['ui.playground.forms', 'Radio Group'],
    'data display' => ['ui.playground.data-display', 'Recent invoices'],
    'navigation' => ['ui.playground.navigation', 'Breadcrumb'],
    'interaction' => ['ui.playground.interaction', 'Command'],
    'application' => ['ui.playground.application', 'Application composition'],
    'blocks' => ['ui.playground.blocks', 'Dashboard-01'],
    'authentication' => ['ui.playground.authentication', 'Password Field'],
]);
