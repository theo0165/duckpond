<x-layout title="{{ $user->username }}">
    <h1>{{ $user->username }}</h1>
    <p>Add some bio?</p>
    <p>Profile created: {{ $user->created_at }}</p>
    <p>Posts made:
        @if ($user->posts->count() > 0)
        <a href="{{ route('users.posts', $user) }}">{{ $user->posts->count() }}</a>
        @else
        <span>0</span>
        @endif
    </p>
    <p>Comments made:
        @if ($user->comments->count() > 0)
        <a href="{{ route('users.comments', $user) }}">{{ $user->comments->count() }}</a>
        @else
        <span>0</span>
        @endif
    </p>
    <p>Owned communities:
        @if ($user->ownedCommunities->count() > 0)
        <a href="{{ route('users.owned.community', $user) }}">{{ $user->ownedCommunities->count() }}</a>
        @else
        <span>0</span>
        @endif
    </p>
    <p>Followed communities:
        @if ($user->followedCommunities->count() > 0)
        <a href="{{ route('users.followed.community', $user) }}">{{ $user->followedCommunities->count() }}</a>
        @else
        <span>0</span>
        @endif
    </p>
</x-layout>
