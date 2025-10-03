<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'body' => $request->body,
            'user_id' => auth()->id(),
            'post_id' => $postId,
        ]);

        return back()->with('success', 'Comment posted successfully!');
    }

}
