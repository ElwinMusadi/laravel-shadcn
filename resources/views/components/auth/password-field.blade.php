@props([
    'id',
    'name' => 'password',
    'label' => __('Password'),
    'autocomplete' => 'current-password',
    'required' => true,
    'autofocus' => false,
    'invalid' => false,
    'error' => null,
    'helpUrl' => null,
    'helpLabel' => null,
])

@php
    $errorId = $id.'-error';
@endphp

<x-ui.field :invalid="$invalid">
    <div class="flex items-center justify-between gap-4">
        <x-ui.label :for="$id" :required="$required">{{ $label }}</x-ui.label>

        @if ($helpUrl && $helpLabel)
            <a href="{{ $helpUrl }}" class="text-sm font-medium text-primary underline-offset-4 outline-none hover:underline focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-card">
                {{ $helpLabel }}
            </a>
        @endif
    </div>

    <div class="relative" x-data="{ visible: false }">
        <x-ui.input
            {{ $attributes }}
            :id="$id"
            :name="$name"
            type="password"
            x-bind:type="visible ? 'text' : 'password'"
            :required="$required"
            :autofocus="$autofocus"
            :autocomplete="$autocomplete"
            :invalid="$invalid"
            :aria-describedby="$invalid ? $errorId : null"
            class="pr-20"
        />

        <button
            type="button"
            class="absolute inset-y-0 right-0 flex items-center rounded-e-md px-3 text-sm font-medium text-muted-foreground outline-none transition-colors hover:text-foreground focus-visible:ring-2 focus-visible:ring-ring"
            x-on:click="visible = !visible"
            x-bind:aria-pressed="visible.toString()"
            x-bind:aria-label="visible ? @js(__('Hide password')) : @js(__('Show password'))"
            aria-controls="{{ $id }}"
            x-text="visible ? @js(__('Hide')) : @js(__('Show'))"
        ></button>
    </div>

    <x-ui.field.error :id="$errorId" :message="$error" />
</x-ui.field>
