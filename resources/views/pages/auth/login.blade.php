<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <x-auth-session-status :status="session('status')" />

        <x-passkey-verify />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <x-ui.field-group>
                <x-ui.field :invalid="$errors->has('email')">
                    <x-ui.label for="email" required>{{ __('Email address') }}</x-ui.label>
                    <x-ui.input
                        id="email"
                        name="email"
                        :value="old('email')"
                        type="email"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                        :invalid="$errors->has('email')"
                        :aria-describedby="$errors->has('email') ? 'email-error' : null"
                    />
                    <x-ui.field.error id="email-error" name="email" />
                </x-ui.field>

                <x-auth.password-field
                    id="password"
                    :invalid="$errors->has('password')"
                    :error="$errors->first('password')"
                    :help-url="Route::has('password.request') ? route('password.request') : null"
                    :help-label="__('Forgot your password?')"
                />

                <x-ui.field orientation="horizontal" class="items-center gap-3">
                    <x-ui.checkbox id="remember" name="remember" value="1" :checked="old('remember')" />
                    <x-ui.label for="remember" class="cursor-pointer">{{ __('Remember me') }}</x-ui.label>
                </x-ui.field>

                <x-ui.button type="submit" class="w-full" data-test="login-button">
                    {{ __('Log in') }}
                </x-ui.button>
            </x-ui.field-group>
        </form>

        <p class="text-center text-sm text-muted-foreground">
            <span>{{ __('Don\'t have an account?') }}</span>
            <a href="{{ route('register') }}" class="font-medium text-primary underline-offset-4 hover:underline">{{ __('Sign up') }}</a>
        </p>
    </div>
</x-layouts::auth>
