<x-layout>
    <h1>Create reply</h1>
    <form action="{{ route('comment.reply.create', ['community' => $community, 'comment' => $comment]) }}">
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
        <button type="submit">Submit</button>
    </form>
</x-layout>
