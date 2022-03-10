<x-layout>
    <h1 class="mb-5">All communities</h1>
    <ul>
        @foreach($communities as $community)
            <li>
                <a href="{{route('community.show', $community)}}">/c/{{$community->title}}</a>
            </li>
        @endforeach
    </ul>
</x-layout>
