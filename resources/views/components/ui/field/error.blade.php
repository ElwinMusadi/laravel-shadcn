@props([
    'name' => null,
    'message' => null,
])

@php
    $errorMessage = $message;

    if ($errorMessage === null && filled($name) && isset($errors)) {
        $errorMessage = $errors->first($name);
    }
@endphp

@if (filled($errorMessage) || ! $slot->isEmpty())
    <p role="alert" {{ $attributes->class('text-sm font-medium text-destructive') }}>
        {{ $errorMessage ?? $slot }}
    </p>
@endif
