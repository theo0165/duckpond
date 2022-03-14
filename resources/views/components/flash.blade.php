@props(['message'])

@if (session()->has($message))
    @if($message === "error")
        <div class="alert alert-danger">
            <p>{{ session($message) }}</p>
        </div>
    @elseif($message === "success")
        <div class="alert alert-success">
            <p>{{ session($message) }}</p>
        </div>
    @endif
@endif
