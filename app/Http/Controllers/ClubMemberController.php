<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubMemberController extends Controller
{
    public function join($id)
    {
        $club = Club::findOrFail($id);
        $club->members()->syncWithoutDetaching(auth()->id());

        return back()->with('success', '✅ You have joined the club!');
    }

    public function leave($id)
    {
        $club = Club::findOrFail($id);
        $club->members()->detach(auth()->id());

        return back()->with('success', '🚪 You have left the club.');
    }
}
