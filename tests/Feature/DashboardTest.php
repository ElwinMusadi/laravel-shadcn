<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertOk()
        ->assertSee('data-test="dashboard-01"', false)
        ->assertSee('data-test="dashboard-section-cards"', false)
        ->assertSee('Active workspaces')
        ->assertSee('Completed reviews')
        ->assertSee('data-test="dashboard-chart"', false)
        ->assertSee('<svg', false)
        ->assertSee('role="img"', false)
        ->assertSee('dashboard-chart-description', false)
        ->assertSee('data-chart-point', false)
        ->assertSee('data-test="dashboard-chart-data"', false)
        ->assertSee('Selected time range')
        ->assertSee('data-test="dashboard-data-table"', false)
        ->assertSee('<table', false)
        ->assertSee('Project brief')
        ->assertSee('In review')
        ->assertSee('data-test="dashboard-row-action-1"', false)
        ->assertSee('aria-label="Breadcrumb"', false);
});

test('dashboard block renders static demo data in responsive component surfaces', function () {
    $view = $this->blade("@include('blocks.dashboard.dashboard-01')");

    $view
        ->assertSee('sm:grid-cols-2', false)
        ->assertSee('xl:grid-cols-4', false)
        ->assertSee('overflow-x-auto', false)
        ->assertSee('Last 30 days')
        ->assertSee('Planning notes')
        ->assertSee('data-test="dashboard-table-row-4"', false);
});
