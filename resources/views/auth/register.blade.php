<x-layout title="Register">
    <h1>Register</h1>
    <form action="{{ route('auth.register.user') }}" method="post">
    @csrf
        <div>
            <x-form.input name="username" required />
        </div>
        <div>
            <x-form.input name="email" type="email" required />
        </div>
        <div>
        <x-form.input name="password" type="password" required />
        </div>
        <div>
            <x-form.button>Sign up</x-form.button>
        </div>
    </form>
</x-layout>
