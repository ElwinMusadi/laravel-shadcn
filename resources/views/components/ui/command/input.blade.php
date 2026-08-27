@props(['label' => 'Search commands'])

<label :for="`${commandId}-input`" class="sr-only">{{ $label }}</label>

<x-ui.input
    type="search"
    x-ref="input"
    x-model="query"
    x-bind:id="`${commandId}-input`"
    x-bind:aria-controls="`${commandId}-list`"
    @keydown.down.prevent="moveActiveItem(1)"
    @keydown.up.prevent="moveActiveItem(-1)"
    @keydown.enter.prevent="selectActiveItem()"
    @keydown.escape="query = ''; $dispatch('command-close')"
    {{ $attributes }}
/>
