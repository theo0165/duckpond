<x-layout title="{{ $user->username }} - Follows">
    <h1>{{ $user->username }} follows:</h1>
    <ul>
        @foreach ($user->followedCommunities as $community)
            <li>
                <a href="{{ route('community.show', $community) }}">/c/{{ $community->title }}</a>
            </li>
        @endforeach
    </ul>
</x-layout>
