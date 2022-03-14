<x-layout>
    <h1>/c/{{$community->title}}</h1>
    <a href="{{ route('submit.show') }}?community={{ $community->title }}">Submit a post</a>
    @if ($checkFollows === null)
        <form action="{{ route('user.follow', $community) }}" method="post">
        @csrf
            <button type="submit">Follow</button>
        </form>
    @elseif ($checkFollows)
        <form action="{{ route('user.unfollow', $community) }}" method="post">
        @csrf
            <button type="submit">Unfollow</button>
        </form>
    @else
         <form action="{{ route('user.follow', $community) }}" method="post">
        @csrf
            <button type="submit">Follow</button>
        </form>
    @endif
    @can('delete', $community)
        <form action="{{ route('community.delete', $community) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
        </form>
    @endcan
    <hr>
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="row justify-content-center">
                <div class="d-inline-block pb-3">
                    <p class="mb-0">
                        Posted to <a href="{{route('community.show', $post->community)}}">/c/{{$post->community->title}}</a>
                        by <a href="{{route('users.profile', $post->user)}}">/u/{{$post->user->username}}</a>
                        ({{$post->created_at->diffForHumans()}})
                    </p>
                    <p class="mb-0">{{$post->votes ?? 0}} points | {{$post->comments_count}} comments</p>
                    <div>
                        <a href="{{route('post.upvote', ['community' => $post->community, 'post' => $post->getHashId()])}}">Upvote</a>
                        <a href="{{route('post.downvote', ['community' => $post->community, 'post' => $post->getHashId()])}}">Downvote</a>
                    </div>
                </div>
                <div class="">
                    @if($post->type === "link")
                        <a href="{{$post->content}}">{{$post->title}}</a>
                    @else
                        <p>{{$post->title}}</p>
                        <p>{{$post->excerpt()}}</p>
                    @endif
                    <div>
                        <a href="{{route('post.show', ['community' => $post->community, 'post' => $post->getHashId()])}}">Go to post</a>
                    </div>
                    <div>
                    @can('delete', $post)
                        <form action="{{ route('post.delete', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post">
                            @csrf
                            @method('DELETE')
                                <button type="submit">Delete post</button>
                        </form>
                    @endcan
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    @else
    <p>No posts yet.</p>
    @endif
</x-layout>
