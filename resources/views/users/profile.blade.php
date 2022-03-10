<x-layout title="{{ $user->username }}">
    <h1>{{ $user->username }}</h1>
    <p>Profile created: {{ $user->created_at }}</p>
    <p>Posts made:
        @if ($user->posts_count > 0)
            <a href="{{ route('users.posts', $user) }}">{{ $user->posts_count }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    <p>Comments made:
        @if ($user->comments_count > 0)
            <a href="{{ route('users.comments', $user) }}">{{ $user->comments_count }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    <p>Owned communities:
        @if ($user->ownedCommunities_count > 0)
            <a href="{{ route('users.owned.community', $user) }}">{{ $user->ownedCommunities_count }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    <p>Followed communities:
        @if ($user->followedCommunities_count > 0)
            <a href="{{ route('users.followed.community', $user) }}">{{ $user->followedCommunities_count }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    @can('update', $user)
        <a href="{{ route('users.profile.edit', $user) }}">Update</a>
    @endcan
    <hr>
    <p>Add some bio?</p>
</x-layout>
