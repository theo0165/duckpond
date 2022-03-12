<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;

class StoreCommunityController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user()->id;

        $this->validate($request, [
            'title' => ['required', 'string', 'max:255']
        ]);

        $newCommunity = Community::create([
            'user_id' => $user,
            'title' => $request->title,
        ]);

        return redirect()->route('community.show', $newCommunity);
    }
}
