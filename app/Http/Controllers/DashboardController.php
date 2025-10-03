<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ✅ Clubs the user CREATED (as owner)
        $ownedClubs = Club::where('user_id', $user->id)->get();

        // ✅ Clubs the user JOINED (but not created)
        $joinedClubs = $user->clubs()->where('clubs.user_id', '!=', $user->id)->get();

        return view('dashboard', compact('ownedClubs', 'joinedClubs'));
    }
}
