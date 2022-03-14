<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Community;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeletePostController extends Controller
{
    public function __invoke(Community $community, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect(
            "/c/$community->title"
        )->with('success', 'Post deleted!');
    }
}
