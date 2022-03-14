@foreach($comments as $comment)
    <ul>
        <li>
            <a href="{{ route('users.profile', $comment->owner) }}"><b>/u/{{$comment->owner->username}}</b></a>
            <p>{{$comment->content}}</p>
            <div>
                <p>
                    {{$comment->vote_count}} points
                    <form action="{{ route('comment.upvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post">
                        @csrf
                        <input type="submit" value="Upvote" class="btn btn-success">
                    </form>
                    <form action="{{ route('comment.downvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post">
                        @csrf
                        <input type="submit" value="Downvote" class="btn btn-warning">
                    </form>
                    <form action="{{ route('comment.show', ['community' => $community, 'post' => $post->getHashId(), 'comment' => $comment->getHashId()]) }}" method="get">
                        @csrf
                        <input type="submit" value="Reply" class="btn btn-primary">
                    </form>
                    @can('delete', $comment)
                        <form action="{{ route('comment.delete', ['community' => $community, 'post' => $post->getHashId(), 'comment' => $comment->getHashId()]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete comment</button>
                        </form>
                    @endcan
                </p>
            </div>
        </li>
        @include('partials.comments', ['comments' => $comment->allChildren])
    </ul>
@endforeach
