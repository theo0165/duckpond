<x-layout>
    <h1>Front page</h1>
    @foreach ($posts as $post)
        <div class="row justify-content-center">
            <div>
                <p>Posted to <a href="{{route('community.show', $post->community)}}">/c/{{$post->community->title}}</a> by <a href="{{route('users.profile', $post->user)}}">/u/{{$post->user->username}}</a></p>
            </div>
            <div class="">
                @if($post->type === "link")
                    <a href="{{$post->content}}">{{$post->title}}</a>
                @else
                    <p>{{$post->title}}</p>
                    <p>{{$post->excerpt()}}</p>
                @endif
                <div>
                    <a href="{{route('post.show', ['community' => $post->community, 'post' => $post])}}">Go to post</a>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</x-layout>
