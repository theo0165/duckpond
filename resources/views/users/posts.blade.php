<x-layout title="{{ $user->username }} - Posts">
    <h1>{{ $user->username }}'s posts:</h1>
    @foreach ($user->posts as $post)
        @php
            if (!Auth::guest()) {
                $hasVoted = $post->votes()->where('user_id', auth()->user()->id)->first();
            } else {
                $hasVoted = null;
            }
        @endphp
        <div class="row justify-content-center">
            <div class="d-inline-block pb-3">
                <p class="mb-0">
                    Posted to <a href="{{route('community.show', $post->community)}}">/c/{{$post->community->title}}</a>
                    by <a href="{{route('users.profile', $post->user)}}">/u/{{$post->user->username}}</a>
                    ({{$post->created_at->diffForHumans()}})
                </p>
                <p class="mb-0">{{$post->votes ?? 0}} points | {{$post->comments_count}} comments</p>
                <div>
                    @if ($hasVoted === null )
                    <form action="{{route('post.upvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post" class="d-inline">
                    @csrf
                        <input type="submit" value="Upvote" class="btn btn-outline-success mt-2">
                    </form>
                    <form action="{{route('post.downvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Downvote" class="btn btn-outline-warning mt-2">
                    </form>
                    @elseif ($hasVoted->value === 1)
                    <form action="{{route('post.upvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post" class="d-inline">
                    @csrf
                        <input type="submit" value="Upvote*" class="btn btn-outline-success mt-2">
                    </form>
                    <form action="{{route('post.downvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Downvote" class="btn btn-outline-warning mt-2">
                    </form>
                    @elseif ($hasVoted->value === -1)
                    <form action="{{route('post.upvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post" class="d-inline">
                    @csrf
                        <input type="submit" value="Upvote" class="btn btn-outline-success mt-2">
                    </form>
                    <form action="{{route('post.downvote', ['community' => $post->community, 'post' => $post->getHashId()])}}" method="post" class="d-inline">
                        @csrf
                        <input type="submit" value="Downvote*" class="btn btn-outline-warning mt-2">
                    </form>
                    @endif
                </div>
            </div>
            <div class="">
                @if($post->type === "link")
                    <a href="{{$post->content}}">{{$post->title}}</a>
                @else
                    <p class="fw-bold mt-3">{{$post->title}}</p>
                    <p>{{$post->excerpt()}}</p>
                @endif
                <div>
                    <a href="{{route('post.show', ['community' => $post->community, 'post' => $post->getHashId()])}}">Go to post</a>
                </div>
                @can('delete', $post)
                    <form action="{{ route('post.delete', ['community' => $post->community, 'post' => $post->getHashId()]) }}" method="post">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger mt-3">Delete post</button>
                    </form>
                @endcan
            </div>
        </div>
        <hr>
    @endforeach
</x-layout>
