<x-layout title="{{ $user->username }}">
    <h1>{{ $user->username }}</h1>
    <p>Profile created: {{ $user->created_at }}</p>
    <p>Posts made:
        @if ($user->posts_count)
            <a href="{{ route('users.posts', $user) }}">{{ $user->posts_count }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    <p>Comments made:
        @if ($user->comments_count)
            <a href="{{ route('users.comments', $user) }}">{{ $user->comments_count }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    <p>Owned communities:
        @if ($user->ownedCommunities->count())
            <a href="{{ route('users.owned.community', $user) }}">{{ $user->ownedCommunities->count() }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    <p>Followed communities:
        @if ($user->followedCommunities->count())
            <a href="{{ route('users.followed.community', $user) }}">{{ $user->followedCommunities->count() }}</a>
        @else
            <span>0</span>
        @endif
    </p>
    @can('update', $user)
        <form action="{{ route('users.profile.edit', $user) }}" method="GET">
            @csrf
            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    @endcan
    @can('delete', $user)
        <form method="post" action="{{ route('users.profile.delete', $user) }}">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    @endcan
    <hr>
    <h2>About me</h2>
    @if ($user->bio)
        <p>{{ $user->bio }}</p>
    @else
        <p>No added bio yet.</p>
    @endif
</x-layout>
