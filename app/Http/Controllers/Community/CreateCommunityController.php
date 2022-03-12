<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;

class CreateCommunityController extends Controller
{
    public function __invoke()
    {
        return view('community.create');
    }
}
