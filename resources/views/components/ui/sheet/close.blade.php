@props(['label' => 'Close sheet'])

<x-ui.button variant="ghost" size="icon" type="button" aria-label="{{ $label }}" @click="open = false" {{ $attributes }}>
    <span aria-hidden="true">×</span>
</x-ui.button>
