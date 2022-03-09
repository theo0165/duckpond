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
                <a href="{{route('post.upvote', ['community' => $post->community, 'post' => $post])}}">Upvote</a>
                <a href="{{route('post.downvote', ['community' => $post->community, 'post' => $post])}}">Downvote</a>
            </div>
        </div>
        <div class="">
            <p>{{$post->content}}</p>
        </div>
        <hr>
        <form class="">
            <div>
                <label class="form-label">Comment:</label>
                <textarea name="content" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit" class="form-control mt-3 btn btn-primary">
        </form>
        <div>
            @foreach($post->comments as $comment):
                <ul>
                    <li>{{$comment->content}} - {{$comment->id}}</li>
                    @foreach($comment->allChildren as $child)
                        <ul>
                            <li>{{$child->content}} - {{$child->id}}</li>
                            @if ($nextLevel = $child->allChildren)
                                {{App\Models\Comment::printChildren($nextLevel)}}
                            @endif
                        </ul>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</x-layout>
