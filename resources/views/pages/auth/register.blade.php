<x-layouts::auth :title="__('Register')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <x-ui.field-group>
                <x-ui.field :invalid="$errors->has('name')">
                    <x-ui.label for="name" required>{{ __('Name') }}</x-ui.label>
                    <x-ui.input
                        id="name"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        :placeholder="__('Full name')"
                        :invalid="$errors->has('name')"
                        :aria-describedby="$errors->has('name') ? 'name-error' : null"
                    />
                    <x-ui.field.error id="name-error" name="name" />
                </x-ui.field>

                <x-ui.field :invalid="$errors->has('email')">
                    <x-ui.label for="email" required>{{ __('Email address') }}</x-ui.label>
                    <x-ui.input
                        id="email"
                        name="email"
                        :value="old('email')"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="email@example.com"
                        :invalid="$errors->has('email')"
                        :aria-describedby="$errors->has('email') ? 'email-error' : null"
                    />
                    <x-ui.field.error id="email-error" name="email" />
                </x-ui.field>

                <div class="grid gap-4 sm:grid-cols-2">
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
                </div>

                <x-ui.button type="submit" class="w-full" data-test="register-user-button">
                    {{ __('Create account') }}
                </x-ui.button>
            </x-ui.field-group>
        </form>

        <p class="text-center text-sm text-muted-foreground">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" class="font-medium text-primary underline-offset-4 hover:underline">{{ __('Log in') }}</a>
        </p>
    </div>
</x-layouts::auth>
