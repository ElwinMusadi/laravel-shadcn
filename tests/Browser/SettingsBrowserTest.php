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

test('keeps Settings content within the standard page container at every application breakpoint', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = $this->visit(route('profile.edit'));

    foreach ([[390, 844], [768, 900], [1024, 900], [1440, 900]] as [$width, $height]) {
        $page
            ->resize($width, $height)
            ->assertVisible('[data-test="settings-page-container"]')
            ->assertVisible('[data-test="settings-nav-profile"]')
            ->assertVisible('#profile-name')
            ->assertVisible('#profile-email')
            ->assertVisible('[data-test="update-profile-button"]');

        expect($page->script('(() => {
            const container = document.querySelector(\'[data-test="settings-page-container"]\');
            const main = document.querySelector(\'[data-test="application-main"]\');
            const navigation = document.querySelector(\'[data-test="settings-nav-profile"]\');
            const heading = container.querySelector(\'h1\');
            const controls = [
                navigation,
                document.querySelector(\'#profile-name\'),
                document.querySelector(\'#profile-email\'),
                document.querySelector(\'[data-test="update-profile-button"]\'),
            ];
            const containerRect = container.getBoundingClientRect();
            const mainStyle = getComputedStyle(main);
            const styles = getComputedStyle(container);
            const left = containerRect.left + parseFloat(styles.paddingLeft);
            const right = containerRect.right - parseFloat(styles.paddingRight);

            return heading
                && navigation.getAttribute(\'aria-current\') === \'page\'
                && left > containerRect.left
                && right < containerRect.right
                && [heading, ...controls].every((element) => {
                    const rect = element.getBoundingClientRect();

                    return rect.left >= left && rect.right <= right;
                })
                && mainStyle.overflowY === \'auto\'
                && window.scrollY === 0
                && document.documentElement.scrollHeight <= document.documentElement.clientHeight
                && document.documentElement.scrollWidth <= document.documentElement.clientWidth;
        })()'))->toBeTrue();
    }

    $page
        ->resize(1440, 900)
        ->assertPathIs('/settings/profile')
        ->assertNoJavaScriptErrors();

    $this->visit(route('dashboard'))
        ->resize(1440, 900)
        ->assertVisible('[data-test="dashboard-01"]')
        ->assertMissing('[data-test="settings-page-container"]')
        ->assertNoJavaScriptErrors();
});
