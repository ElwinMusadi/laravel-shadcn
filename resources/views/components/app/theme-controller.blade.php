<script data-theme-controller>
    (() => {
        const themeStorageKey = 'theme';

        const storedTheme = () => {
            try {
                return window.localStorage.getItem(themeStorageKey);
            } catch (_) {
                return null;
            }
        };

        const applyStoredTheme = () => {
            document.documentElement.classList.toggle('dark', storedTheme() === 'dark');
        };

        applyStoredTheme();

        window.themeController = () => ({
            theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',

            init() {
                this.sync();
            },

            isDark() {
                return this.theme === 'dark';
            },

            sync() {
                this.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            },

            setTheme(theme) {
                const nextTheme = theme === 'dark' ? 'dark' : 'light';

                document.documentElement.classList.toggle('dark', nextTheme === 'dark');

                try {
                    window.localStorage.setItem(themeStorageKey, nextTheme);
                } catch (_) {
                }

                this.sync();
                window.dispatchEvent(new Event('theme-changed'));
            },

            toggle() {
                this.setTheme(this.isDark() ? 'light' : 'dark');
            },
        });

        if (!window.themeControllerNavigationListenerRegistered) {
            document.addEventListener('livewire:navigating', (event) => {
                event.detail.onSwap(() => {
                    applyStoredTheme();
                });
            });

            window.themeControllerNavigationListenerRegistered = true;
        }
    })();
</script>
