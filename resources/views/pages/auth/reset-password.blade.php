<x-layouts::auth :title="__('Reset password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Reset password')" :description="__('Please enter your new password below')" />

        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-6">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <x-ui.field-group>
                <x-ui.field :invalid="$errors->has('email')">
                    <x-ui.label for="email" required>{{ __('Email address') }}</x-ui.label>
                    <x-ui.input
                        id="email"
                        name="email"
                        :value="old('email', request('email'))"
                        type="email"
                        required
                        autocomplete="email"
                        :invalid="$errors->has('email')"
                        :aria-describedby="$errors->has('email') ? 'email-error' : null"
                    />
                    <x-ui.field.error id="email-error" name="email" />
                </x-ui.field>

                <x-auth.password-field
                    id="password"
                    autocomplete="new-password"
                    :invalid="$errors->has('password')"
                    :error="$errors->first('password')"
                />

                <x-auth.password-field
                    id="password_confirmation"
                    name="password_confirmation"
                    :label="__('Confirm password')"
                    autocomplete="new-password"
                    :invalid="$errors->has('password_confirmation')"
                    :error="$errors->first('password_confirmation')"
                />

                <x-ui.button type="submit" class="w-full" data-test="reset-password-button">
                    {{ __('Reset password') }}
                </x-ui.button>
            </x-ui.field-group>
        </form>
    </div>
</x-layouts::auth>
