@props(['duration' => 5000])

@php
    $autoDismissDuration = max((int) $duration, 0);
@endphp

@persist('toast')
    <div
        aria-live="polite"
        aria-atomic="false"
        aria-relevant="additions"
        class="pointer-events-none fixed inset-x-4 bottom-4 z-50 flex max-w-sm flex-col gap-3 sm:left-auto sm:right-4"
        data-test="toast-region"
        x-data="{
            duration: @js($autoDismissDuration),
            nextId: 1,
            toasts: [],
            add(event) {
                const detail = event.detail ?? {};
                const text = typeof detail.text === 'string' ? detail.text.trim() : '';

                if (!text) {
                    return;
                }

                const variants = ['success', 'info', 'warning', 'error'];
                const variant = variants.includes(detail.variant) ? detail.variant : 'info';
                const toast = { id: this.nextId++, text, variant };

                this.toasts.push(toast);

                if (this.duration > 0) {
                    window.setTimeout(() => this.dismiss(toast.id), this.duration);
                }
            },
            dismiss(id) {
                this.toasts = this.toasts.filter((toast) => toast.id !== id);
            },
        }"
        x-on:toast.window="add($event)"
    >
        <template x-for="toast in toasts" :key="toast.id">
            <div
                x-transition.opacity
                x-bind:class="{
                    'border-primary/30 bg-primary text-primary-foreground': toast.variant === 'success',
                    'border-border bg-card text-card-foreground': toast.variant === 'info',
                    'border-accent bg-accent text-accent-foreground': toast.variant === 'warning',
                    'border-destructive bg-destructive text-destructive-foreground': toast.variant === 'error',
                }"
                x-bind:data-toast-variant="toast.variant"
                x-bind:role="toast.variant === 'error' ? 'alert' : 'status'"
                class="pointer-events-auto flex items-start gap-3 rounded-lg border p-4 text-sm font-medium shadow-lg"
                data-test="toast-message"
            >
                <p class="min-w-0 flex-1" x-text="toast.text"></p>

                <button
                    type="button"
                    class="-m-1 rounded-sm p-1 text-current opacity-80 outline-none transition-opacity hover:opacity-100 focus-visible:ring-2 focus-visible:ring-current"
                    aria-label="{{ __('Dismiss notification') }}"
                    data-test="toast-dismiss"
                    x-on:click="dismiss(toast.id)"
                >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </template>
    </div>
@endpersist
