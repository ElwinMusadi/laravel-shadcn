@props([
    'href' => null,
    'disabled' => false,
])

<x-ui.pagination.link :href="$href" :disabled="$disabled" aria-label="Go to previous page" {{ $attributes }}>
    {{ $slot->isEmpty() ? 'Previous' : $slot }}
</x-ui.pagination.link>
