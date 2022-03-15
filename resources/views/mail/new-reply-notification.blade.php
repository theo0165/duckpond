<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div>
        <div>
            <h1>New reply</h1>
            <p>Someone has replied to your {{$type}}</p>
            <p>Click here to check it out:</p>
            <a href="{{ route('post.show', ['community' => $community->title, 'post' => $post->getHashId()]) }}" style="overflow-wrap: anywhere;">{{ route('post.show', ['community' => $community, 'post' => $post->getHashId()]) }}</a>
        </div>
    </div>
</body>
</html>
