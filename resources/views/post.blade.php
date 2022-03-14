<x-layout>
    <h1>{{$post->title}}</h1>
    <div class="row justify-content-center">
        <div class="d-inline-block pb-3">
            <p class="mb-0">
                Posted to <a href="{{route('community.show', $post->community)}}">/c/{{$post->community->title}}</a>
                by <a href="{{route('users.profile', $post->user)}}">/u/{{$post->user->username}}</a>
                ({{$post->created_at->diffForHumans()}})
            </p>
            <p class="mb-0">{{$post->votes ?? 0}} points | {{$post->comments_count}} comments</p>
            <div>
                <form action="{{route('post.upvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post">
                    @csrf
                    <input type="submit" value="Upvote" class="btn btn-success">
                </form>
                <form action="{{route('post.downvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post">
                    @csrf
                    <input type="submit" value="Downvote" class="btn btn-warning">
                </form>
            </div>
            <div>
            @can('delete', $post)
                <form action="{{ route('post.delete', ['community' => $post->community, 'post' => $post->getHashId()]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete post</button>
                </form>
            @endcan
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
        <form method="POST" action="{{ route('post.comment.create', ['community' => $post->community, 'post' => $post->getHashId()]) }}">
            @csrf
            <div>
                <label class="form-label">Comment:</label>
                <textarea name="content" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit" class="form-control mt-3 btn btn-primary">
        </form>
        <div class="mt-5">
            <h3>Comments</h3>
            @include('partials.comments', ['comments' => $comments, 'community' => $post->community, 'post' => $post])
        </div>
    </div>
</x-layout>
