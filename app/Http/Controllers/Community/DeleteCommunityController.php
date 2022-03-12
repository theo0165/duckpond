<?php

namespace App\Http\Controllers\Community;

use App\Models\Community;
use App\Http\Controllers\Controller;

class DeleteCommunityController extends Controller
{
    public function __invoke(Community $community)
    {
        $this->authorize('delete', $community);

        $community->delete();

        return redirect('/')->with('success', 'Community deleted!');
    }
}
