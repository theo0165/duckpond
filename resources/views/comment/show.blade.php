<x-layout>
    <h1>Create reply</h1>
    <form action="{{ route('comment.reply.create', ['community' => $community, 'comment' => $comment->getHashId(), 'post' => $post->getHashId()]) }}" method="post">
        @csrf
        <label for="content">Comment:</label>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <button type="submit">Submit</button>
    </form>
</x-layout>
