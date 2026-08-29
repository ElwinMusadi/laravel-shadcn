<span {{ $attributes->class('inline-flex') }}>
    <span x-data="themeController()" @theme-changed.window="sync()">
        <x-ui.tooltip>
            <x-ui.tooltip.trigger
                aria-label="{{ __('Toggle theme') }}"
                aria-pressed="false"
                x-bind:aria-label="isDark() ? '{{ __('Switch to light mode') }}' : '{{ __('Switch to dark mode') }}'"
                x-bind:aria-pressed="isDark().toString()"
                x-bind:title="isDark() ? '{{ __('Switch to light mode') }}' : '{{ __('Switch to dark mode') }}'"
                @click="toggle()"
                data-test="theme-toggle"
            >
                <x-ui.icon name="moon" class="size-4 dark:hidden" />

                <x-ui.icon name="sun" class="hidden size-4 dark:block" />

                <span class="sr-only" x-text="isDark() ? '{{ __('Dark mode is active') }}' : '{{ __('Light mode is active') }}'">
                    {{ __('Toggle theme') }}
                </span>
            </x-ui.tooltip.trigger>

            <x-ui.tooltip.content x-text="isDark() ? '{{ __('Switch to light mode') }}' : '{{ __('Switch to dark mode') }}'">
                {{ __('Toggle theme') }}
            </x-ui.tooltip.content>
        </x-ui.tooltip>
    </span>
</span>
