<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Club;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show the form to create a new post
    public function create($clubId)
    {
        $club = Club::findOrFail($clubId);
        return view('posts.create', compact('club'));
    }


    public function store(Request $request, $clubId)
    {
        // Validate incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create and save the post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'club_id' => $clubId,
            'user_id' => auth()->id(),
        ]);

        // Redirect to the club's page with a success message
        return redirect()->route('clubs.show', $clubId)->with('success', 'Post created successfully!');
    }


}
