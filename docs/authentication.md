# Authentication

## Arsitektur

Fortify adalah pemilik kontrak autentikasi backend: route, guard web, action, validasi, session, redirect, rate limiter, two-factor authentication, dan passkey. <code>App\Providers\FortifyServiceProvider</code> memasangkan view Fortify ke halaman Blade di <code>resources/views/pages/auth/</code>.

Blade, Livewire, dan Alpine hanya menangani presentasi dan interaksi lokal. Jangan mengubah kontrak Fortify hanya untuk menyamakan UI.

## Flow yang tersedia

| Flow | Presentasi aktual |
| --- | --- |
| Login | <code>pages/auth/login.blade.php</code>, email/password, remember me, dan <code>x-passkey-verify</code>. |
| Registration | <code>pages/auth/register.blade.php</code> dengan name, email, password, confirmation. |
| Password reset | <code>forgot-password.blade.php</code> dan <code>reset-password.blade.php</code>. |
| Email verification | <code>verify-email.blade.php</code> dengan resend link dan logout. |
| Password confirmation | <code>confirm-password.blade.php</code> serta konfirmasi passkey. |
| Two-factor challenge | <code>two-factor-challenge.blade.php</code>, mode OTP atau recovery code. |
| Security settings | Livewire Security page untuk password, 2FA, passkey, recovery code, dan penghapusan akun. |

Fortify dikonfigurasi untuk registration, reset password, email verification, two-factor dengan confirmation/password confirmation, dan passkeys. Home setelah autentikasi adalah <code>/dashboard</code>.

## Komponen auth

Halaman memakai <code>x-layouts::auth</code>, <code>x-auth-header</code>, <code>x-auth-session-status</code>, <code>x-auth.password-field</code>, serta primitive form <code>x-ui.*</code>. Password field selalu mulai sebagai input <code>type="password"</code>, kemudian Alpine hanya mengubah tampil/sembunyi pada klik lokal.

Two-factor challenge memakai input <code>code</code> atau <code>recovery_code</code>. Saat mode berganti, field lain dinonaktifkan dan nilainya dibersihkan. OTP memakai <code>inputmode="numeric"</code>, <code>maxlength="6"</code>, dan <code>autocomplete="one-time-code"</code>.

## Passkeys

Package <code>@laravel/passkeys</code> tetap dipakai. <code>resources/js/passkeys.js</code> mengekspos <code>window.Passkeys</code>. <code>x-passkey-verify</code> menangani verifikasi pada login dan password confirmation; <code>x-passkey-registration</code> menangani pendaftaran dari Security settings.

Passkey adalah ceremony WebAuthn nyata yang membutuhkan browser dan authenticator yang didukung. UI proyek bukan simulasi. Konfigurasi relying party, allowed origin, user handle secret, dan timeout berada di <code>config/fortify.php</code>. Browser test memverifikasi runtime serta kontrol aman, bukan credential ceremony hardware/browser sungguhan.

## Toast

<code>x-app.toast</code> dirender oleh <code>x-app.shell</code>. Event menerima <code>text</code> string non-kosong dan <code>variant</code> salah satu dari <code>success</code>, <code>info</code>, <code>warning</code>, atau <code>error</code>; variant lain menjadi <code>info</code>. Toast non-error memakai <code>role="status"</code>, error memakai <code>role="alert"</code>, dan region memakai <code>aria-live="polite"</code>.

Toast dapat ditutup dengan button keyboard-accessible dan auto-dismiss setelah 5000 ms secara default. Prop <code>duration</code> mengubah durasi; nilai nol menonaktifkan auto-dismiss.

~~~php
$this->dispatch('toast', variant: 'success', text: __('Password updated.'));
~~~

## Batas keamanan

Jangan menambah social login palsu, custom WebAuthn buatan sendiri, atau state auth hanya di Alpine. Pertahankan CSRF form, validation, rate limiting, session invalidation, dan middleware Fortify/Laravel. Uji perubahan auth dengan Feature dan Browser test terkait.
