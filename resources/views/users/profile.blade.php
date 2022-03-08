<x-layout title="{{ $user->username }}">
    <h1>{{ $user->username }}</h1>
    @foreach ($info->posts as $data)
        <h2>{{ $data->title }}</h2>
        <p>Number of posts: {{ $data->count() }} </p>
    @endforeach
</x-layout>
