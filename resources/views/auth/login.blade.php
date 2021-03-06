<x-layout title="Login">
    <h1>Login</h1>
    <form action="{{ route('auth.login.user') }}" method="post">
    @csrf
        <div>
            <x-form.input name="username" value="{{ old('username') }}" required />
        </div>
        <div>
            <x-form.input name="password" type="password" required />
        </div>
        <div class="mt-2">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Remember me</label>
        </div>
        <div>
            <x-form.button>Login</x-form.button>
        </div>
    </form>
    <div><a href="{{ route('forgotpassword.show') }}">Forgot password?</a></div>
    <div><a href="{{ route('auth.register') }}">Not a user? Register here</a></div>
</x-layout>
