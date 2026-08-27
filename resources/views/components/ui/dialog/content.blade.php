<div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-foreground/30 backdrop-blur-[1px]" aria-hidden="true" @click="open = false"></div>

    <div
        x-ref="content"
        :id="`${dialogId}-content`"
        role="dialog"
        aria-modal="true"
        :aria-labelledby="`${dialogId}-title`"
        :aria-describedby="`${dialogId}-description`"
        tabindex="-1"
        @keydown.escape.stop.prevent="open = false"
        @keydown.tab="const focusable = [...$el.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex=\'-1\'])')].filter((element) => !element.hidden); const first = focusable[0]; const last = focusable.at(-1); if (!first) { $event.preventDefault(); $el.focus() } else if ($event.shiftKey && document.activeElement === first) { $event.preventDefault(); last.focus() } else if (!$event.shiftKey && document.activeElement === last) { $event.preventDefault(); first.focus() }"
        {{ $attributes->class('relative z-10 flex max-h-[calc(100dvh-2rem)] w-full max-w-lg flex-col overflow-y-auto rounded-lg border border-border bg-card text-card-foreground shadow-lg outline-none') }}
    >
        {{ $slot }}
    </div>
</div>
