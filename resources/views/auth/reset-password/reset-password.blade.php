<x-layout>
    <h1>Reset password</h1>
    <form action="{{ route('resetpassword.store', $token) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="password" class="form-label">New password:</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm new password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input type="submit" value="Send" class="btn btn-outline-primary mt-3">
    </form>
</x-layout>
