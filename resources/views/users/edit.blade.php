<x-layout title="{{ $user->username }} - Edit">
    <h1>{{ $user->username }}</h1>
    <form action="{{ route('users.profile.update', $user) }}" method="post">
    @csrf
    @method('PATCH')
        <div>
            <x-form.input name="username" value="{{ $user->username }}" />
        </div>
        <div>
            <x-form.input name="email" type="email" value="{{ $user->email }}" />
        </div>
        <div>
            <x-form.input name="password" type="password" value="{{ $user->email }}" />
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
