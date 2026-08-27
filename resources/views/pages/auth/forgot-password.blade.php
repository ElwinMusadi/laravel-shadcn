<x-layouts::auth :title="__('Forgot password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
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

                <x-ui.button type="submit" class="w-full" data-test="email-password-reset-link-button">
                    {{ __('Email password reset link') }}
                </x-ui.button>
            </x-ui.field-group>
        </form>

        <p class="text-center text-sm text-muted-foreground">
            <span>{{ __('Or, return to') }}</span>
            <a href="{{ route('login') }}" class="font-medium text-primary underline-offset-4 hover:underline">{{ __('log in') }}</a>
        </p>
    </div>
</x-layouts::auth>
