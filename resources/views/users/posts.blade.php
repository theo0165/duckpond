<x-layout title="{{ $user->username }} - Posts">
    <h1>{{ $user->username }}'s posts:</h1>
    @foreach ($user->posts as $post)
        <div class="row justify-content-center">
            <div class="d-inline-block pb-3">
                <p class="mb-0">
                    Posted to <a href="{{route('community.show', $post->community)}}">/c/{{$post->community->title}}</a>
                    by <a href="{{route('users.profile', $post->user)}}">/u/{{$post->user->username}}</a>
                    ({{$post->created_at->diffForHumans()}})
                </p>
                <p class="mb-0">{{$post->votes}} points | {{$post->comments_count}} comments</p>
                <div>
                    <a href="{{route('post.upvote', ['community' => $post->community, 'post' => $post])}}">Upvote</a>
                    <a href="{{route('post.downvote', ['community' => $post->community, 'post' => $post])}}">Downvote</a>
                </div>
            </div>
            <div class="">
                @if($post->type === "link")
                    <a href="{{$post->content}}">{{$post->title}}</a>
                @else
                    <p>{{$post->title}}</p>
                    <p>{{$post->excerpt()}}</p>
                @endif
                <div>
                    <a href="{{route('post.show', ['community' => $post->community, 'post' => $post])}}">Go to post</a>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</x-layout>
