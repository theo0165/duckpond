@foreach($comments as $comment):
    <ul>
        <li>{{$comment->content}} - {{$comment->id}}</li>
        @include('partials.comments', ['comments' => $comment->allChildren])
    </ul>
@endforeach
