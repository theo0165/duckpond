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
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item p-3">
                    <a href="/" class="nav-link">Duckpond</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row">
                <li class="nav-item p-3">
                    <a href="{{route('search')}}" class="nav-link">Search</a>
                </li>
            @auth
                <li class="nav-item p-3">
                    <a href="{{route('community.index')}}" class="nav-link">All communities</a>
                </li>
                <li class="nav-item p-3">
                    <a href="{{route('community.create')}}" class="nav-link">Create a community</a>
                </li>
                <li class="nav-item p-3">
                    <a href="{{route('submit.show')}}" class="nav-link">Submit</a>
                </li>
                <li class="nav-item p-3">
                    <a href="{{ route('users.profile', Auth::user()) }}" class="nav-link">{{ auth()->user()->username }}</a>
                </li>
                <li class="nav-item p-3">
                    <form action="{{ route('auth.logout') }}" method="post">
                    @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li class="nav-item p-3">
                    <a href="{{route('community.index')}}" class="nav-link">All communities</a>
                </li>
                <li class="nav-item p-3">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                 <li class="nav-item p-3">
                    <a href="{{ route('auth.register') }}" class="nav-link">Register</a>
                </li>
            @endguest
            </ul>
        </nav>
        <div class="container">
            {{ $slot }}
        </div>
        <x-flash message="success" />
        <x-flash message="error" />
    </body>
</html>
