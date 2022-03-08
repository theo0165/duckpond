<x-layout title="{{ $user->username }} - Comments">
    <h1>{{ $user->username }}</h1>
    <h3>Comments made:</h3>
    @foreach ($user->comments as $comment)
    <h5>{{ $comment->title }}</h5>
    <p>{{ $comment->content }}</p>
    @endforeach
</x-layout>
