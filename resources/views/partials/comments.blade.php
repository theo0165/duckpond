@foreach($comments as $comment):
    <ul>
        <li>
            <b>/u/{{$comment->owner->username}}</b>
            <p>{{$comment->content}}</p>
            <div>
                <p>
                    {{$comment->votes}} points |
                    <a>Upvote</a> |
                    <a>Downvote</a>
                </p>
            </div>
        </li>
        @include('partials.comments', ['comments' => $comment->allChildren])
    </ul>
@endforeach
