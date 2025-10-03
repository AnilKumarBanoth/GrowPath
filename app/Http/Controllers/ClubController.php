<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    public function create()
    {
        return view('clubs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:255',
            'founded_date' => 'nullable|date',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'address' => 'required|string',
            'website' => 'nullable|url',
        ]);

        $club = Club::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'founded_date' => $request->founded_date,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
            'website' => $request->website,
        ]);

        // 👑 Make the creator a member (entrepreneur role)
        $club->members()->attach(auth()->id(), ['role' => 'entrepreneur']);

        return redirect()->route('clubs.index')->with('success', 'Club created successfully!');
    }

    public function show(Club $club)
    {
        // Restrict access only to members
        if (!$club->members->contains(auth()->id())) {
            abort(403, 'You are not a member of this club.');
        }

        $posts = $club->posts()->with('author')->latest()->get();

        return view('clubs.show', compact('club', 'posts'));
    }


    public function index()
    {
        $clubs = Club::with('members')->get(); // Show all clubs
        return view('clubs.index', compact('clubs'));
    }

    // 👥 Show Members Page
    // 👥 Show Members Page
    // 👥 Show Members Page
    public function members(Club $club)
    {
        $members = $club->members; // Get all members with pivot data

        // Check if the logged-in user is the owner (entrepreneur)
        $isOwner = auth()->user()->isEntrepreneurOf($club);

        return view('clubs.members', compact('club', 'members', 'isOwner'));
    }



    // ❌ Remove Member
    public function removeMember(Club $club, User $user)
    {
        if (!auth()->user()->isEntrepreneurOf($club)) {
            abort(403, 'Unauthorized');
        }

        // Prevent owner from removing themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot remove yourself from your own club.');
        }

        $club->members()->detach($user->id);

        return back()->with('success', 'Member removed successfully.');
    }
}
