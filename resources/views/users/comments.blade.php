<x-layout title="{{ $user->username }} - Comments">
    <h1>{{ $user->username }}'s comments:</h1>
    @foreach ($commentsWithData as $comment)
        <div class="row justify-content-center">
            <div class="">
                <p>{{ $comment->content }}</p>
                <p>{{ $comment->votes_count }} points</p>
            </div>
        </div>
        <hr>
    @endforeach
</x-layout>
