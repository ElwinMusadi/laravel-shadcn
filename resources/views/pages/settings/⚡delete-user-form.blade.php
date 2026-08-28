<?php

use Livewire\Component;

new class extends Component {}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <x-ui.heading variant="section">{{ __('Delete account') }}</x-ui.heading>
        <p class="mt-2 text-sm leading-6 text-muted-foreground">{{ __('Delete your account and all of its resources') }}</p>
    </div>

    <livewire:pages::settings.delete-user-modal />
</section>
