<x-layouts::auth :title="__('Two-factor authentication')">
    <div class="flex flex-col gap-6">
        <div
            class="relative w-full"
            x-cloak
            x-data="{
                showRecoveryInput: @js($errors->has('recovery_code')),
                code: '',
                recovery_code: '',
                focusOtp() {
                    this.$nextTick(() => this.$refs.code?.focus());
                },
                init() {
                    if (! this.showRecoveryInput) {
                        this.focusOtp();
                    }
                },
                toggleInput() {
                    this.showRecoveryInput = !this.showRecoveryInput;

                    this.code = '';
                    this.recovery_code = '';

                    $nextTick(() => {
                        this.showRecoveryInput
                            ? this.$refs.recovery_code?.focus()
                            : this.focusOtp();
                    });
                },
            }"
        >
            <div x-show="!showRecoveryInput" x-transition.opacity>
                <x-auth-header
                    :title="__('Authentication code')"
                    :description="__('Enter the authentication code provided by your authenticator application.')"
                    id="two-factor-code-title"
                />
            </div>

            <div x-show="showRecoveryInput" x-transition.opacity>
                <x-auth-header
                    :title="__('Recovery code')"
                    :description="__('Please confirm access to your account by entering one of your emergency recovery codes.')"
                    id="two-factor-recovery-title"
                />
            </div>

            <form method="POST" action="{{ route('two-factor.login.store') }}" class="mt-6">
                @csrf

                <x-ui.field-group>
                    <x-ui.field x-show="!showRecoveryInput" :invalid="$errors->has('code')">
                        <x-ui.label for="code" required>{{ __('Authentication code') }}</x-ui.label>
                        <x-ui.input
                            id="code"
                            name="code"
                            type="text"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="6"
                            autocomplete="one-time-code"
                            x-ref="code"
                            x-model="code"
                            x-bind:required="!showRecoveryInput"
                            x-bind:disabled="showRecoveryInput"
                            :invalid="$errors->has('code')"
                            :aria-describedby="$errors->has('code') ? 'code-error' : null"
                        />
                        <x-ui.field.error id="code-error" name="code" />
                    </x-ui.field>

                    <x-ui.field x-show="showRecoveryInput" :invalid="$errors->has('recovery_code')">
                        <x-ui.label for="recovery_code" required>{{ __('Recovery code') }}</x-ui.label>
                        <x-ui.input
                            id="recovery_code"
                            name="recovery_code"
                            type="text"
                            autocomplete="one-time-code"
                            x-ref="recovery_code"
                            x-model="recovery_code"
                            x-bind:required="showRecoveryInput"
                            x-bind:disabled="!showRecoveryInput"
                            :invalid="$errors->has('recovery_code')"
                            :aria-describedby="$errors->has('recovery_code') ? 'recovery-code-error' : null"
                        />
                        <x-ui.field.error id="recovery-code-error" name="recovery_code" />
                    </x-ui.field>

                    <x-ui.button type="submit" class="w-full">
                        {{ __('Continue') }}
                    </x-ui.button>

                    <x-ui.button
                        variant="link"
                        type="button"
                        class="h-auto self-center px-0 py-0 text-center"
                        x-on:click="toggleInput()"
                        x-text="showRecoveryInput ? @js(__('Use an authentication code instead')) : @js(__('Use a recovery code instead'))"
                    ></x-ui.button>
                </x-ui.field-group>

            </form>
        </div>
    </div>
</x-layouts::auth>
