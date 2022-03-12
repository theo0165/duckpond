@props(['message'])

@if (session()->has($message))
    <p>{{ session($message) }}</p>
@endif
