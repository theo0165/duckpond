<x-layout title="{{ $user->username }} - Edit">
    <h1>{{ $user->username }}</h1>
    <form action="{{ route('users.profile.update', $user) }}" method="post">
    @csrf
    @method('PATCH')
        <div>
            <x-form.input name="username" value="{{ old('username') ?? $user->username }}" />
        </div>
        <div>
            <x-form.input name="email" type="email" value="{{ old('email') ?? $user->email }}" />
        </div>
        <div>
            <x-form.input name="password" type="password"/>
        </div>
        <div>
            <x-form.textarea name="bio">{{ $user->bio }}</x-form.textarea>
        </div>
        <div>
            <button type="submit">Save profile info</button>
        </div>
    </form>
    @can('delete', $user)
        <form action="{{ route('users.profile.delete', $user) }}" method="post">
        @csrf
        @method('DELETE')
            <button type="submit">Delete my account</button>
        </form>
    @endcan
</x-layout>
