<?php

namespace App\Http\Controllers\submit;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;

class ShowSubmitController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('submit', [
            'communities' => auth()->user()->followedCommunities
        ]);
    }
}
