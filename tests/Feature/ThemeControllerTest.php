<?php

use App\Models\User;

test('the application and authentication layouts install the light-default theme controller', function () {
    $home = $this->get(route('home'));
    $login = $this->get(route('login'));
    $user = User::factory()->create();

    $dashboard = $this->actingAs($user)->get(route('dashboard'));

    $dashboard
        ->assertSee('data-theme-controller', false)
        ->assertSee('data-test="theme-toggle"', false)
        ->assertSee('aria-label="Toggle theme"', false)
        ->assertSee('x-bind:aria-pressed="isDark().toString()"', false)
        ->assertDontSee('<html lang="'.app()->getLocale().'" class="dark">', false);

    $home
        ->assertSee('data-theme-controller', false)
        ->assertDontSee('<html lang="'.app()->getLocale().'" class="dark">', false);

    $login
        ->assertSee('data-theme-controller', false)
        ->assertDontSee('<html lang="'.app()->getLocale().'" class="dark">', false);
});

test('appearance settings expose only the shared light and dark controls', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('appearance.edit'));

    $response
        ->assertSee('data-test="theme-settings"', false)
        ->assertSee('data-test="theme-settings-light"', false)
        ->assertSee('data-test="theme-settings-dark"', false)
        ->assertSee('x-data="themeController()"', false)
        ->assertSee('x-on:change="setTheme(\'light\')"', false)
        ->assertSee('x-on:change="setTheme(\'dark\')"', false)
        ->assertDontSee('System', false);
});
