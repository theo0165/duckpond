<x-layout title="Login">
    <h1>Login</h1>
    <form action="{{ route('auth.login.user') }}" method="post">
    @csrf
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</x-layout>
