<x-layout title="{{ $user->username }} - Follows">
    <h1>{{ $user->username }}</h1>
    <h3>Followed communities:</h3>
    @foreach ($user->followedCommunities as $community)
    <h5>{{ $community->title}}</h5><span>(link to community)</span>
    @endforeach
</x-layout>
