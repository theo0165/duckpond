@foreach($comments as $comment)
    <ul>
        <li>
            <a href="{{ route('users.profile', $comment->owner) }}"><b>/u/{{$comment->owner->username}}</b></a>
            <p>{{$comment->content}}</p>
            <div>
                <p>
                    {{$comment->votes}} points |
                    <a href="{{ route('comment.upvote', ['community' => $community, 'comment' => $comment->getHashedId()]) }}">Upvote</a> |
                    <a href="{{ route('comment.downvote', ['community' => $community, 'comment' => $comment->getHashedId()]) }}">Downvote</a> |
                    <a href="">Reply</a>
                </p>
            </div>
        </li>
        @include('partials.comments', ['comments' => $comment->allChildren])
    </ul>
@endforeach
