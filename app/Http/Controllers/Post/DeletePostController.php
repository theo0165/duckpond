<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Community;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeletePostController extends Controller
{
    public function __invoke(Post $post, Community $community)
    {
        $this->authorize('delete', $post);

        $post->delete();

        // return redirect()->route('community.show', $community)->with('success', 'Post deleted!');
        return redirect('/')->with('success', 'Post deleted!');
    }
}
