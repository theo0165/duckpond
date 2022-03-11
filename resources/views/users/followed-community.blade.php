<x-layout title="{{ $user->username }} - Follows">
    <h1>{{ $user->username }}</h1>
    <h3>Followed communities:</h3>
    @foreach ($user->followedCommunities as $community)
    <a href="{{ route('community.show', $community) }}">/c/{{ $community->title }}</a>
    @endforeach
</x-layout>
