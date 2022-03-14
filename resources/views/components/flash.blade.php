@props(['message'])

@if (session()->has($message))
    @if($message === "error")
        <div class="alert alert-danger text-center">
            <p class="mt-0 mb-0">{{ session($message) }}</p>
        </div>
    @elseif($message === "success")
        <div class="alert alert-success text-center">
            <p class="mt-0 mb-0">{{ session($message) }}</p>
        </div>
    @endif
@endif
