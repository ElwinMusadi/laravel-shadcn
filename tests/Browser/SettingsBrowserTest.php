<?php

use App\Models\User;
use Laravel\Fortify\Features;

test('keeps settings actions, toasts, theme, and Livewire navigation usable', function () {
    $user = User::factory()->create();

    $this->actingAs($user);
    $this->withSession(['auth.password_confirmed_at' => time()]);

    $page = $this->visit(route('profile.edit'));

    $page
        ->assertVisible('#profile-name')
        ->assertAttribute('#profile-name', 'autocomplete', 'name')
        ->type('#profile-name', 'Updated Browser User')
        ->click('[data-test="update-profile-button"]')
        ->assertSee('Profile updated.')
        ->assertVisible('[data-test="toast-message"][data-toast-variant="success"]')
        ->assertAttribute('[data-test="toast-region"]', 'aria-live', 'polite')
        ->click('[data-test="toast-dismiss"]')
        ->assertMissing('[data-test="toast-message"]')
        ->click('[aria-label="Switch to dark mode"]')
        ->assertScript('document.documentElement.classList.contains("dark")', true)
        ->click('[data-test="settings-nav-security"]')
        ->wait(1)
        ->assertPathIs(parse_url(route('security.edit'), PHP_URL_PATH))
        ->assertScript('document.documentElement.classList.contains("dark")', true)
        ->type('#current-password', 'incorrect-password')
        ->type('#new-password', 'updated-browser-password')
        ->type('#new-password-confirmation', 'updated-browser-password')
        ->click('[data-test="update-password-button"]')
        ->assertAttribute('#current-password', 'aria-invalid', 'true');

    $page->script('window.dispatchEvent(new CustomEvent("toast", { detail: { variant: "error", text: "Unable to save security settings." } }))');

    $page
        ->assertSee('Unable to save security settings.')
        ->assertAttribute('[data-test="toast-message"][data-toast-variant="error"]', 'role', 'alert')
        ->click('[data-test="toast-dismiss"]')
        ->assertMissing('[data-test="toast-message"]')
        ->assertNoJavaScriptErrors()
        ->assertNoAccessibilityIssues(1);
});

test('renders passkey integration, recovery codes, and account deletion confirmation', function () {
    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]);
    Features::passkeys([
        'confirmPassword' => true,
    ]);

    $user = User::factory()->create();
    $user->forceFill([
        'two_factor_secret' => encrypt('browser-test-secret'),
        'two_factor_recovery_codes' => encrypt(json_encode(['recovery-code-1', 'recovery-code-2'])),
        'two_factor_confirmed_at' => now(),
    ])->save();

    $this->actingAs($user);
    $this->withSession(['auth.password_confirmed_at' => time()]);

    $page = $this->visit(route('security.edit'));

    $page
        ->assertVisible('[data-test="passkey-registration"]')
        ->assertScript('typeof window.Passkeys?.register === "function"', true)
        ->assertSee('2FA recovery codes')
        ->click('View recovery codes')
        ->assertVisible('#recovery-codes-section')
        ->assertSee('recovery-code-1')
        ->assertAttribute('button[x-show="showRecoveryCodes"][aria-controls="recovery-codes-section"]', 'aria-expanded', 'true')
        ->assertNoJavaScriptErrors()
        ->assertNoAccessibilityIssues(1);

    $this->visit(route('profile.edit'))
        ->click('[data-test="delete-user-button"]')
        ->assertVisible('[role="dialog"][aria-labelledby="confirm-user-deletion-title"]')
        ->click('Cancel')
        ->assertMissing('[role="dialog"][aria-labelledby="confirm-user-deletion-title"]')
        ->assertNoJavaScriptErrors();
});
