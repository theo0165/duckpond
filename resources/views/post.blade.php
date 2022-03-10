<x-layout>
    <h1>{{$post->title}}</h1>
    <div class="row justify-content-center">
        <div class="d-inline-block pb-3">
            <p class="mb-0">
                Posted to <a href="{{route('community.show', $post->community)}}">/c/{{$post->community->title}}</a>
                by <a href="{{route('users.profile', $post->user)}}">/u/{{$post->user->username}}</a>
                ({{$post->created_at->diffForHumans()}})
            </p>
            <p class="mb-0">{{$post->votes}} points | {{$post->comments_count}} comments</p>
            <div>
                <a href="{{route('post.upvote', ['community' => $post->community, 'post' => $post->getHashId()])}}">Upvote</a>
                <a href="{{route('post.downvote', ['community' => $post->community, 'post' => $post->getHashId()])}}">Downvote</a>
            </div>
        </div>
        <div class="mb-3">
            @if($post->type === "link")
                <a href="{{$post->content}}">{{$post->content}}</a>
            @else
                <p>{{$post->content}}</p>
            @endif
        </div>
        <hr>
        <form class="">
            <div>
                <label class="form-label">Comment:</label>
                <textarea name="content" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit" class="form-control mt-3 btn btn-primary">
        </form>
        <div class="mt-5">
            <h3>Comments</h3>
            @include('partials.comments', ['comments' => $comments, 'community' => $post->community])
        </div>
    </div>
</x-layout>
