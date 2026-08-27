@php
    $user = auth()->user();
@endphp

@if ($user)
    <x-ui.dropdown id="application-user-menu" data-test="application-user-menu">
        <x-ui.dropdown.trigger variant="ghost" size="icon" aria-label="{{ __('Open user menu for :name', ['name' => $user->name]) }}" data-test="application-user-menu-trigger">
            <x-ui.avatar class="size-8">
                <x-ui.avatar.fallback aria-hidden="true">{{ $user->initials() }}</x-ui.avatar.fallback>
            </x-ui.avatar>
        </x-ui.dropdown.trigger>

        <x-ui.dropdown.content align="end" data-test="application-user-menu-content">
            <div class="flex items-center gap-3 px-2 py-1.5" role="presentation">
                <x-ui.avatar class="size-9">
                    <x-ui.avatar.fallback>{{ $user->initials() }}</x-ui.avatar.fallback>
                </x-ui.avatar>

                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-foreground">{{ $user->name }}</p>
                    <p class="truncate text-xs text-muted-foreground">{{ $user->email }}</p>
                </div>
            </div>

            <x-ui.dropdown.separator />

            <x-ui.dropdown.group>
                <x-ui.dropdown.item href="{{ route('profile.edit') }}" wire:navigate>
                    {{ __('Settings') }}
                </x-ui.dropdown.item>
            </x-ui.dropdown.group>

            <x-ui.dropdown.separator />

            <form method="POST" action="{{ route('logout') }}" data-test="logout-form">
                @csrf

                <x-ui.dropdown.item type="submit" data-test="logout-button">
                    {{ __('Log out') }}
                </x-ui.dropdown.item>
            </form>
        </x-ui.dropdown.content>
    </x-ui.dropdown>
@endif
