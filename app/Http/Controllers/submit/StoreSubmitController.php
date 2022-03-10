<?php

namespace App\Http\Controllers\submit;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Rules\PostTypeRule;
use Illuminate\Http\Request;

class StoreSubmitController extends Controller
{
    public function __invoke(Request $request)
    {
        $postData = $request->validate([
            'type' => ['required', 'string', 'in:text,link'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string', new PostTypeRule],
            'community' => ['required', 'exists:communities,title']
        ]);

        dd($postData);
    }
}
