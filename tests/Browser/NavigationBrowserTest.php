<?php

use App\Models\User;

test('changes tabs with arrow keys while skipping disabled tabs', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->visit(route('ui.playground.navigation'))
        ->assertAttribute('[role="tab"][data-value="account"]', 'aria-selected', 'true')
        ->keys('[role="tab"][data-value="account"]', 'ArrowRight')
        ->assertAttribute('[role="tab"][data-value="security"]', 'aria-selected', 'true')
        ->assertVisible('#playground-tabs-panel-security')
        ->keys('[role="tab"][data-value="security"]', 'End')
        ->assertScript('document.activeElement.dataset.value', 'security')
        ->assertDisabled('[role="tab"][data-value="billing"]')
        ->assertNoJavaScriptErrors()
        ->assertNoAccessibilityIssues(1);
});
