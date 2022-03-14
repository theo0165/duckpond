<x-layout>
    <h1>Create reply</h1>
    <p>Parent</p>
    <ul>
        <li>
            <a href="{{ route('users.profile', $comment->owner) }}"><b>/u/{{$comment->owner->username}}</b></a>
            <p>{{$comment->content}}</p>
        </li>
    </ul>
    <form action="{{ route('comment.reply.create', ['community' => $community, 'comment' => $comment->getHashId(), 'post' => $post->getHashId()]) }}" method="post">
        @csrf
        <div>
            <label for="content" class="form-label">Comment:</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-outline-primary mt-3">Submit</button>
    </form>
</x-layout>
