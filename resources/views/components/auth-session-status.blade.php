@props([
    'status',
])

@if ($status)
    <div role="status" aria-live="polite" {{ $attributes->class('rounded-md border border-primary/20 bg-primary/10 px-3 py-2 text-sm font-medium text-foreground') }}>
        {{ $status }}
    </div>
@endif
