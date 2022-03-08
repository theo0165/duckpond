<x-layout title="{{ $user->username }} - Posts">
    <h1>{{ $user->username }}</h1>
    <h3>Posts made:</h3>
    @foreach ($user->posts as $post)
    <h5>{{ $post->title }}</h5>
    <p>{{ $post->content }}</p>
    @endforeach
</x-layout>
