@foreach($comments as $comment)
    @php
        if (!Auth::guest()) {
            $hasVoted = $post->votes()->where('user_id', auth()->user()->id)->first();
        } else {
            $hasVoted = null;
        }
        // $hasVoted = $comment->votes()->where('user_id', auth()->user()->id)->first()
    @endphp
    <ul>
        <li>
            <a href="{{ route('users.profile', $comment->owner) }}"><b>/u/{{$comment->owner->username}}</b></a>
            <p>{{$comment->content}}</p>
            <div>
                <p>
                    {{$comment->vote_count ?? 0}} points
                    @if ($hasVoted === null )
                    <form action="{{ route('comment.upvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Upvote" class="btn btn-outline-success">
                    </form>
                    <form action="{{ route('comment.downvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Downvote" class="btn btn-outline-warning">
                    </form>
                    @elseif ($hasVoted->value === 1)
                    <form action="{{ route('comment.upvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Upvote*" class="btn btn-outline-success">
                    </form>
                    <form action="{{ route('comment.downvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Downvote" class="btn btn-outline-warning">
                    </form>
                    @elseif ($hasVoted->value === -1)
                    <form action="{{ route('comment.upvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Upvote" class="btn btn-outline-success">
                    </form>
                    <form action="{{ route('comment.downvote', ['community' => $community, 'comment' => $comment->getHashId()]) }}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Downvote*" class="btn btn-outline-warning">
                    </form>
                    @endif
                    <form action="{{ route('comment.show', ['community' => $community, 'post' => $post->getHashId(), 'comment' => $comment->getHashId()]) }}" method="get" class="d-inline">
                        @csrf
                        <input type="submit" value="Reply" class="btn btn-outline-primary">
                    </form>
                    @can('delete', $comment)
                        <form action="{{ route('comment.delete', ['community' => $community, 'post' => $post->getHashId(), 'comment' => $comment->getHashId()]) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete comment</button>
                        </form>
                    @endcan
                </p>
            </div>
        </li>
        @include('partials.comments', ['comments' => $comment->allChildren])
    </ul>
@endforeach

