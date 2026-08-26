@props([
    'href' => null,
    'disabled' => false,
])

<x-ui.pagination.link :href="$href" :disabled="$disabled" aria-label="Go to next page" {{ $attributes }}>
    {{ $slot->isEmpty() ? 'Next' : $slot }}
</x-ui.pagination.link>
