<x-layout title="{{ $user->username }} - Owned">
    <h1>{{ $user->username }}'s communities:</h1>
    <ul>
        @foreach ($user->ownedCommunities as $community)
            <li>
                <a href="{{route('community.show', $community)}}">/c/{{ $community->title}}</a>
            </li>
        @endforeach
    </ul>
</x-layout>
