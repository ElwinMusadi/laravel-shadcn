<?php

use App\Concerns\PasswordValidationRules;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component {
    use PasswordValidationRules;

    public string $password = '';

    /**
     * Reset the confirmation state when its dialog closes.
     */
    public function closeModal(): void
    {
        $this->reset('password');
        $this->resetErrorBag();
    }

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => $this->currentPasswordRules(),
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-ui.dialog
    id="confirm-user-deletion"
    :open="$errors->isNotEmpty()"
    x-data
    x-on:dialog-closed.window="if ($event.detail.id === 'confirm-user-deletion') { $wire.closeModal() }"
>
    <x-ui.dialog.trigger variant="destructive" data-test="delete-user-button">
        {{ __('Delete account') }}
    </x-ui.dialog.trigger>

    <x-ui.dialog.content class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6 p-6">
            <x-ui.dialog.header class="p-0">
                <x-ui.dialog.title>{{ __('Are you sure you want to delete your account?') }}</x-ui.dialog.title>
                <x-ui.dialog.description>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </x-ui.dialog.description>
            </x-ui.dialog.header>

            <x-auth.password-field
                id="delete-account-password"
                wire:model="password"
                label="{{ __('Password') }}"
                :invalid="$errors->has('password')"
                :error="$errors->first('password')"
            />

            <div class="flex justify-end gap-2">
                <x-ui.button variant="outline" type="button" x-on:click="close()">{{ __('Cancel') }}</x-ui.button>

                <x-ui.button variant="destructive" type="submit" data-test="confirm-delete-user-button">
                    {{ __('Delete account') }}
                </x-ui.button>
            </div>
        </form>
    </x-ui.dialog.content>
</x-ui.dialog>
