<?php

use App\Models\User;

test('redirects guests away from the playground', function () {
    $this->visit(route('ui.playground'))
        ->assertPathIs('/login')
        ->assertSee('Log in to your account');
});

test('renders the email verification notice through the Fortify route', function () {
    $unverifiedUser = User::factory()->unverified()->create();

    $this->actingAs($unverifiedUser);

    $this->get(route('verification.notice'))
        ->assertOk()
        ->assertSee('Verify your email');
});

test('renders accessible login controls and authenticates with email and password', function () {
    $user = User::factory()->create([
        'email' => 'browser@example.test',
        'password' => 'password',
    ]);

    $page = $this->visit(route('login'));

    $page
        ->resize(390, 844)
        ->assertSee('Log in to your account')
        ->assertVisible('input[name="email"]')
        ->assertVisible('input[name="password"]')
        ->assertAttribute('input[name="email"]', 'autocomplete', 'email')
        ->assertAttribute('input[name="password"]', 'autocomplete', 'current-password')
        ->click('[aria-label="Show password"]')
        ->assertAttribute('input[name="password"]', 'type', 'text')
        ->click('[aria-label="Hide password"]')
        ->assertAttribute('input[name="password"]', 'type', 'password')
        ->check('remember')
        ->type('email', $user->email)
        ->type('password', 'password')
        ->click('Log in')
        ->assertPathIs('/dashboard')
        ->assertSee('Dashboard')
        ->assertNoJavaScriptErrors();
});

test('presents invalid login feedback without invoking passkey WebAuthn', function () {
    $user = User::factory()->create([
        'email' => 'invalid-login@example.test',
        'password' => 'password',
    ]);

    $this->visit(route('login'))
        ->assertScript('typeof window.PublicKeyCredential !== "undefined"', true)
        ->type('email', $user->email)
        ->type('password', 'incorrect-password')
        ->click('Log in')
        ->assertPathIs('/login')
        ->assertAttribute('input[name="email"]', 'aria-invalid', 'true')
        ->assertNoJavaScriptErrors();
});
