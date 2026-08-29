@props(['side' => 'right'])

@php
    $positions = [
        'top' => 'inset-x-0 top-0 max-h-[calc(100dvh-2rem)] w-full',
        'right' => 'inset-y-0 right-0 h-dvh w-full max-w-[calc(100vw-2rem)] sm:max-w-sm',
        'bottom' => 'inset-x-0 bottom-0 max-h-[calc(100dvh-2rem)] w-full',
        'left' => 'inset-y-0 left-0 h-dvh w-full max-w-[calc(100vw-2rem)] sm:max-w-sm',
    ];

    $offCanvasClasses = [
        'top' => '-translate-y-full',
        'right' => 'translate-x-full',
        'bottom' => 'translate-y-full',
        'left' => '-translate-x-full',
    ];

    $offCanvasClass = $offCanvasClasses[$side] ?? $offCanvasClasses['right'];
@endphp

<div
    x-cloak
    x-show="open"
    x-transition:enter="transition-none duration-200 motion-reduce:duration-0"
    x-transition:leave="transition-none duration-200 motion-reduce:duration-0"
    class="fixed inset-0 z-50 h-dvh"
>
    <div
        x-show="open"
        x-transition:enter="duration-200 ease-linear"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="duration-200 ease-linear"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-foreground/30 backdrop-blur-[1px] transition-opacity duration-200 ease-linear motion-reduce:transition-none"
        aria-hidden="true"
        @click="open = false"
    ></div>

    <section
        x-show="open"
        x-ref="content"
        :id="`${sheetId}-content`"
        :data-state="open ? 'open' : 'closed'"
        role="dialog"
        aria-modal="true"
        :aria-labelledby="`${sheetId}-title`"
        :aria-describedby="`${sheetId}-description`"
        tabindex="-1"
        x-transition:enter="duration-200 ease-linear"
        x-transition:enter-start="{{ $offCanvasClass }}"
        x-transition:enter-end="translate-x-0 translate-y-0"
        x-transition:leave="duration-200 ease-linear"
        x-transition:leave-start="translate-x-0 translate-y-0"
        x-transition:leave-end="{{ $offCanvasClass }}"
        @keydown.escape.stop.prevent="open = false"
        @keydown.tab="const focusable = Array.from($el.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex=\'-1\'])')).filter((element) => !element.hidden); const first = focusable[0]; const last = focusable.at(-1); if (!first) { $event.preventDefault(); $el.focus() } else if ($event.shiftKey && document.activeElement === first) { $event.preventDefault(); last.focus() } else if (!$event.shiftKey && document.activeElement === last) { $event.preventDefault(); first.focus() }"
        {{ $attributes->class([
            'fixed z-10 flex flex-col overflow-y-auto border-border bg-card text-card-foreground shadow-lg outline-none transition-transform duration-200 ease-linear motion-reduce:transition-none',
            $positions[$side] ?? $positions['right'],
            in_array($side, ['top', 'bottom'], true) ? 'border-y' : 'border-x',
        ]) }}
    >
        {{ $slot }}
    </section>
</div>
