<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowCreateCommentController extends Controller
{
    public function __invoke()
    {
        return view('comment.show')
    }
}
