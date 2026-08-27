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
                <svg class="size-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8Z" />
                </svg>

                <svg class="hidden size-4 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="4" />
                    <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                </svg>

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
