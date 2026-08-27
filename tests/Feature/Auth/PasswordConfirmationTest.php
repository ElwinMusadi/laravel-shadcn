<?php

use App\Models\User;

test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('password.confirm'));

    $response
        ->assertOk()
        ->assertSee('Confirm password')
        ->assertSee('action="'.route('password.confirm.store').'"', false)
        ->assertSee('autocomplete="current-password"', false)
        ->assertSee(route('passkey.confirm-options'), false);
});
