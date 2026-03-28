<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::query()
            ->with(['departments', 'photoMedia'])
            ->active()
            ->get();

        return view('website.team', compact('teamMembers'));
    }
}
