<x-layout title="{{ $user->username }} - Owned">
    <h1>{{ $user->username }}</h1>
    <h3>Owned communities:</h3>
    @foreach ($user->ownedCommunities as $community)
    <h5>{{ $community->title}}</h5><span>(link to community)</span>
    @endforeach
</x-layout>
