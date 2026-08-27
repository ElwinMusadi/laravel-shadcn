<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Appearance settings')] class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-ui.heading as="h2" class="sr-only">{{ __('Appearance settings') }}</x-ui.heading>

    <x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        <x-ui.radio-group
            label="{{ __('Theme') }}"
            description="{{ __('Choose the appearance for this browser. Light is the default when no preference is stored.') }}"
            x-data="themeController()"
            @theme-changed.window="sync()"
            data-test="theme-settings"
        >
            <x-ui.radio-group.option
                name="theme"
                value="light"
                x-bind:checked="! isDark()"
                x-on:change="setTheme('light')"
                data-test="theme-settings-light"
            >
                {{ __('Light') }}
            </x-ui.radio-group.option>

            <x-ui.radio-group.option
                name="theme"
                value="dark"
                x-bind:checked="isDark()"
                x-on:change="setTheme('dark')"
                data-test="theme-settings-dark"
            >
                {{ __('Dark') }}
            </x-ui.radio-group.option>
        </x-ui.radio-group>
    </x-pages::settings.layout>
</section>
