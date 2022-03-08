<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@isset($title){{ $title }} -@endisset Duckpond</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        @production
            @php
                $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            @endphp

            <script type="module" src="/build/{{$manifest['resources/js/app.js']['file']}}"></script>
            <link rel="stylesheet" href="/build/{{$manifest['resources/js/app.js']['css'][0]}}">
        @else
            <script type="module" src="http://localhost:3000/@vite/client"></script>
            <script type="module" src="http://localhost:3000/resources/js/app.js"></script>
        @endproduction
    </head>
    <body>
        <nav>
            <ul>
                <li>
                    <a href="/">Duckpond</a>
                </li>
            </ul>
            <ul>
            @auth
                <li>
                    {{-- <a href="{{ route('users.profile', $user) }}">{{ auth()->user()->username }}</a> --}}
                </li>
                <li>
                    <form action="{{ route('auth.logout') }}" method="post">
                    @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('auth.login') }}">Login</a>
                </li>
                 <li>
                    <a href="{{ route('auth.register') }}">Register</a>
                </li>
            @endguest
            </ul>
        </nav>
        {{ $slot }}
    </body>
</html>
