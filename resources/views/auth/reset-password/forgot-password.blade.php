<x-layout>
    <h1>Forgot password</h1>
    <form action="{{ route('forgotpassword.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email') ?? ''}}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input type="submit" value="Send" class="btn btn-outline-primary mt-3">
    </form>
</x-layout>
