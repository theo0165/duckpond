<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $posts = [];

        if ($request->query('q')) {
            $posts = Post::searchPosts($request->get('q'));
        }

        return view('search.show', [
            'posts' => $posts
        ]);
    }
}
